<?php


namespace App\Services;

use App\Base\Service\BaseService;
use App\Base\WrongNamespaceException;
use App\Helpers\Views\AdminHelpers;
use App\Models\Upload;
use App\Repositories\Interfaces\IUploadRepository;
use App\Services\Interfaces\IUploadService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

class UploadService extends BaseService implements IUploadService
{
    private $request;
    private $fileService;
    private $oneSession;
    /**
     * UploadedService constructor.
     * @param Request $request
     * @param FileService $fileService
     * @param IUploadRepository $uploadedRepository
     * @param OneSession $oneSession
     */
    public function __construct(
        Request $request,
        FileService $fileService,
        OneSession $oneSession
    )
    {
        parent::__construct();

        $this->request = $request;
        $this->fileService = $fileService;
        $this->oneSession = $oneSession;
    }

    /**
     * Загрузка данных. Итог - двумерный массив ['field' => []]
     *
     * @return array
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function loadData(): array {
        $url = $this->request->getPathInfo();
        $session_id = $this->oneSession->getSessionId();
        $user_id = $this->oneSession->geUserId();

        $data = $this->getRepository()->getByFieldsUploads($url, $session_id, $user_id);

        $result = [];
        /** @var Upload $upload */
        foreach ($data as $key => $uploads) {
            $result[$key] = [];
            foreach ($uploads as $upload) {
                $item = $upload->file->attributesToArray();
                $item['id'] = $upload->id;
                $item['description'] = $upload->description;
                $item['field'] = $upload->field;
                $item['file_path'] = $upload->file->getPath();
                $item['file_src'] = $this->fileService->getAssetUrl($upload->file);
                $item['local_file'] = $this->fileService->getLocalFile($upload->file);
                $item['delete_url'] = '?cmd=DeleteFile&file_id=' . $upload->id;

                if($item['local_file'] !== null)
                    $result[$key][] = $item;
            }
        }
        return $result;
    }
    public function empty(): bool
    {
        try {
            return (count($this->loadData()) <= 0);
        } catch (Exception $e) {
        }
        return false;
    }
    /**
     * @param array $data
     * @param UploadedFile $file
     */
    public function validateUploadFiles(array $data, UploadedFile $file) {
        if(!$file->isValid()) {
            $errorMsg = sprintf("Ошибка загрузки файла %s: %s", $file->getClientOriginalName(), $file->getErrorMessage());
            throw new InvalidArgumentException($errorMsg, $file->getError());
        }
        if(!$this->fileService->isImage($file)) {
            $errorMsg = sprintf("Файл %s не является картинкой", $file->getClientOriginalName());
            throw new InvalidArgumentException($errorMsg);
        }
    }
    /**
     * @param array $only
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function uploadFiles(array $only = []) {
        $allFiles = $this->request->allFiles();
        $url = $this->request->getPathInfo();
        $filesData = $this->loadData();

        foreach($allFiles as $key => $file) {
            // Исключаем лишние файлы
            if(!empty($only) && !in_array($key, $only))
                continue;
            // файлики по принимаем по одному, если там массив - это не наш клиент
            if(!($file instanceof UploadedFile))
                continue;

            $loadedFiles = array_key_exists($key, $filesData) ? $filesData[$key] : [];
            $cntLoaded = count($loadedFiles);

            $data = [
                'url' => $url,
                'field' => $key,
                'description' => $this->request->get($key . '_description'),
                'sort' => $cntLoaded + 1
            ];

            try {
                $this->validateUploadFiles($data, $file);
                // если поле множественное - добавляем к сессии,
                // иначе - добавляем если коллекция пуста, заменяем, если есть 1 элемент
                $this->uploadFile($key, $file, $data);
                if(!static::isMul($key) && $cntLoaded)
                    $this->removeFile($loadedFiles[0]['id']);
            }
            catch (Exception $ex) {  }
        }
    }
    /**
     * @param array $only
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function updateFiles(array $only = []) {
        $filesData = $this->loadData();

        foreach($filesData as $key => $files) {
            // Исключаем лишние файлы
            if (!empty($only) && !in_array($key , $only))
                continue;

            foreach($files as $i => $file) {
                $var_name = $key . '_description' . $file['id'];
                $data = [
                    // 'sort' => $i + 1,
                    'description' => $this->request->get($var_name, '')
                ];
                try {
                    $this->updateData($file['id'], $data);
                }
                catch (Exception $ex) {
                }
            }
        }
    }
    /**
     * @param array $only
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function removeFiles(array $only = []) {
        $filesData = $this->loadData();

        foreach($filesData as $key => $uploads) {
            // Исключаем лишние файлы
            if (!empty($only) && !in_array($key , $only))
                continue;

            foreach($uploads as $i => $upload) {
                $var_name = $key . '_delete' . $upload['id'];
                if(AdminHelpers::isTrue($this->request->get($var_name, ''))) {
                    try {
                        $this->removeFile($upload['id']);
                    }
                    catch (Exception $ex) { }
                }
            }
        }
    }
    /**
     * @param string $name
     * @return bool
     */
    public static function isMul(string $name): bool {
        return (substr($name, -1, 1) == 's');
    }
    /**
     * @param Upload $item
     * @return bool
     */
    public function isOwnFile(Upload $item): bool {
        return $item->user_id == $this->oneSession->geUserId()
            || $item->session_id == $this->oneSession->getSessionId();
    }
    /**
     * @param string $field
     * @param UploadedFile $file
     * @param array $data
     * @return Upload
     * @throws BindingResolutionException
     * @throws FileNotFoundException
     * @throws WrongNamespaceException
     */
    public function uploadFile(string $field, UploadedFile $file, array $data): Upload {
        if(!array_key_exists('url', $data))
            $data['url'] = $this->request->getPathInfo();
        if(!array_key_exists('field', $data))
            $data['field'] = $field;
        if(!array_key_exists('field', $data))
            $data['field'] = $field;

        $data['user_id'] = $this->oneSession->geUserId();
        $data['session_id'] = $this->oneSession->getSessionId();

        $fileModel = $this->fileService->saveFile($file);
        $data['file_id'] = $fileModel->id;

        /** @var Upload $uploaded */
        $uploaded = $this->store($data);

        return $uploaded;
    }

    /**
     * @param int $item_id
     * @param array $data
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     * @throws Exception
     */
    public function updateData(int $item_id, array $data) {
        /** @var IUploadRepository $repository */
        $repository = $this->getRepository();
        /** @var Upload $item */
        $item = $repository->getByPrimary($item_id);
        if($item && $this->isOwnFile($item))
            $repository->updateFromArray($item, $data);
    }
    /**
     * @param int $item_id
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     * @throws Exception
     */
    public function removeFile(int $item_id) {
        /** @var IUploadRepository $repository */
        $repository = $this->getRepository();
        /** @var Upload $item */
        $item = $repository->getByPrimary($item_id);

        if($item && $this->isOwnFile($item)) {
            $file = $item->file;
            $item->file()->dissociate();
            $item->save();
            $this->fileService->removeFile($file);
            $repository->remove($item);
        }
    }

    /**
     * @param int $item_id
     * @return int
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function detachFile(int $item_id): int {
        /** @var IUploadRepository $repository */
        $repository = $this->getRepository();
        /** @var Upload $item */
        $item = $repository->getByPrimary($item_id);

        if($item && ($item->user_id == $this->oneSession->geUserId())) {
            $file_id = $item->file->id;
            $item->file()->dissociate();
            $item->save();
            $repository->remove($item);

            return $file_id;
        }

        return 0;
    }
    /**
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function clearOldFiles() {
        /** @var IUploadRepository $repository */
        $repository = $this->getRepository();
        $uploads = $repository->getOldUploads();
        /** @var Upload $upload */
        foreach($uploads as $upload) {
            $this->removeFile($upload->id);
        }
    }
    /**
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function clearCurrent() {
        $filesData = $this->loadData();
        foreach($filesData as $key => $uploads) {
            foreach($uploads as $upload) {
                try {
                    $this->removeFile($upload['id']);
                }
                catch (Exception $ex) {  }
            }
        }
    }
    /**
     * @return FileService
     */
    public function getFileService(): FileService {
        return $this->fileService;
    }
}
