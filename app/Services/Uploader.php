<?php

namespace App\Services;

use App\Models\Format;
use Illuminate\Support\Facades\File;
use App\Http\Resources\Format as FormatResource;

class Uploader
{
    protected $uploadFile,
        $fileProps = [],
        $uploadPath,
        $newUploadName,
        $validationFailed = false,
        $formats;

    /**
     * @var ImageValidationBuilder
     */
    protected $imageValidationBuilder;

    /**
     * Image format id
     *
     * @var int
     */
    private $formatId;

    public function __construct($formatModel, ImageValidationBuilder $imageValidationBuilder) {
        $this->formats = FormatResource::collection($formatModel->all());
        $this->imageValidationBuilder = $imageValidationBuilder;
    }

    protected function setProps($name, $value)
    {
        $this->fileProps[$name] = $value;
    }

    protected function setValidationFailed($value) {
        $this->validationFailed = $value;
    }

    public function getValidationFailed() {
        return $this->validationFailed;
    }

    protected function setFormatId($width, $height, $formats) {
        if($height != 0) {
            $ratio = $width / $height;

            foreach($formats as $format) {
                if($ratio >= $format->min && $ratio < $format->max) {
                    $this->formatId = $format->id;
                    return;
                }
            }
        }
        $this->setValidationFailed(true);
        abort(422, 'Пропорции изображения ' . $this->fileProps['original_name'] . ' не входят в допустимые пределы!');
    }

    /**
     * Возвращает id формата изображения
     *
     * @param FormatResource::collection $formats
     * @param number $ratio
     *
     * @return mixed
     */
    protected function findFormat($formats, $ratio) {
        foreach($formats as $format) {
            if($ratio >= $format->min && $ratio < $format->max) {
                return $format->id;
            }
        }
        return false;
    }

    public function validate($uploadFile, $rules)
    {
        $this->clearState();
        if ($uploadFile->isValid()) {
            $this->uploadFile = $uploadFile;

            $this->setProps('size', $this->uploadFile->getSize());
            $this->setProps('original_name', $this->getOriginalName($this->uploadFile));
            $this->setProps('extension', mb_strtolower($this->uploadFile->getClientOriginalExtension()));
            $this->setProps('mime', $this->uploadFile->getMimeType());

            $this->imageValidationBuilder
                ->init($this->fileProps, $rules)
                ->isAllowExtension()
                ->isAllowMime()
                ->isAllowMinSize()
                ->isAllowMaxSize()
                ->isAllow();

        } else {
            $this->setValidationFailed(true);
            abort(422, trans('image_validation.loading_failed', [
                'file_name' => $this->fileProps['original_name']
            ]));
        }

        $this->setFormatId(getImageSize($this->uploadFile)[0], getImageSize($this->uploadFile)[1], $this->formats);
        $this->setProps('width', getImageSize($this->uploadFile)[0]);
        $this->setProps('height', getImageSize($this->uploadFile)[1]);
        $this->setProps('format_id', $this->formatId);

        return !$this->getValidationFailed();
    }

    public function upload($basePath = null)
    {
        if ($this->getValidationFailed()) return false;
        $basePath = $basePath ?? ltrim(config('uploads.imageUploadPath', ''));
        $this->newUploadName = sha1($this->fileProps['original_name'] . microtime(true)) . '.' . $this->fileProps['extension'];
        $newDir = substr($this->newUploadName, 0, 1) . '/' . substr($this->newUploadName, 0, 3);

        $this->uploadPath = str_replace('/', '.', $newDir . '/' . $this->newUploadName);
        $newPath = $basePath . '/' . $newDir;

        if (!File::exists($newPath)) {
            if (!File::makeDirectory($newPath, config('uploads.storagePermissions', 0755), true)) {
                abort(422, 'Не могу создать директорию «' . $newPath . '»!');
            }
        }

        if (File::isDirectory($newPath) && File::isWritable($newPath)) {

            $this->uploadFile->move($newPath, $this->newUploadName);

        } else {
            abort(422, 'Директория «' . $newPath . '» недоступна для записи!');
        }

        return File::exists($newPath . '/' . $this->newUploadName) ? $this->newUploadName : false;
    }

    public function register($uploadModel)
    {
        return $uploadModel->create([
            'path' => $this->newUploadName,
            'extension' => $this->fileProps['extension'],
            'mime' => $this->fileProps['mime'],
            'width' => $this->fileProps['width'],
            'height' => $this->fileProps['height'],
            'format_id' => $this->fileProps['format_id']
        ]);
    }

    public function update($uploadModel)
    {
        return $uploadModel->fill([
            'path' => $this->newUploadName,
            'extension' => $this->fileProps['extension'],
            'mime' => $this->fileProps['mime'],
            'width' => $this->fileProps['width'],
            'height' => $this->fileProps['height'],
            'format_id' => $this->fileProps['format_id']
        ])->save();
    }

    protected function clearState()
    {
        unset($this->uploadFile, $this->request, $this->fileProps);
    }

    public function remove($uploadPath, $basePath = null)
    {
        $basePath = $basePath ?? ltrim(config('uploads.imageUploadPath', ''));
        $dir = substr($uploadPath, 0, 1) . '/' . substr($uploadPath, 0, 3);
        $pathToDelete = $basePath . $dir . '/' . $uploadPath;
        return File::delete($pathToDelete);
    }

    /**
     * Returns the original name of uploaded file
     *
     * @param $uploadFile
     * @return string|string[]|null
     */
    protected function getOriginalName($uploadFile) : string {
        return preg_replace('/\.' . $uploadFile->getClientOriginalExtension() . '$/', '', $uploadFile->getClientOriginalName());
    }
}
