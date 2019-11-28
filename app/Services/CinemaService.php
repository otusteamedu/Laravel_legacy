<?php


namespace App\Services;


use App\Base\Service\BaseService;
use App\Events\CinemaEvent;
use App\Models\Cinema;
use App\Services\Interfaces\ICinemaService;
use App\Services\Interfaces\IUploadService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CinemaService extends BaseService implements ICinemaService
{
    protected $uploadService;

    public function __construct(IUploadService $uploadService) {
        parent::__construct();

        $this->uploadService = $uploadService;
    }
    /**
     * проверить данные перед сохранением
     * @param array $data
     */
    protected function validateStore(array $data) {
        Validator::make($data, [
            'name' => ['required', 'max:255']
        ])->validate();
    }
    /**
     * @param array $data
     * @return Model
     * @throws ValidationException
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function store(array $data): Model {
        $this->validateStore($data);

        $uploads = $this->uploadService->loadData();
        if(isset($uploads['photos']) && count($uploads['photos'])) {
            $data['photos_id'] = [];
            foreach ($uploads['photos'] as $photo) {
                $upload_id = $photo['id'];
                $data['photos_id'] = $this->uploadService->detachFile($upload_id);
            }
        }
        elseif(array_key_exists('photos', $data)) {
            $data['photos_id'] = [];
            if($data['photos'] instanceof UploadedFile)
                $data['photos'] = array($data['photos']);

            foreach ($data['photos'] as $photo) {
                if($photo instanceof UploadedFile) {
                    $fileModel = $this->uploadService->getFileService()->saveFile($photo);
                    $data['photos_id'] = $fileModel->id;
                }
            }

            unset($data['photos']);
        }
        /** @var Cinema $cinema */
        $cinema = $this->getRepository()->createFromArray($data);

        // $this->uploadService->clearCurrent();

        event(new CinemaEvent($cinema, CinemaEvent::STORED));

        return $cinema;
    }
}
