<?php


namespace App\Services;


use App\Base\Service\BaseService;
use App\Events\UserEvent;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Interfaces\IUploadService;
use App\Services\Interfaces\IUserService;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class UserService extends BaseService implements IUserService
{
    protected $uploadService;

    public function __construct(IUploadService $uploadService) {
        parent::__construct();

        $this->uploadService = $uploadService;
    }

    /**
     * проверить данные перед сохранением
     * @param array $data
     * @throws ValidationException
     */
    protected function validateStore(array $data)
    {
        \Illuminate\Support\Facades\Validator::make($data, [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255']
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
        if(isset($uploads['poster']) && count($uploads['poster'])) {
            $upload_id = $uploads['poster'][0]['id'];
            $data['poster_id'] = $this->uploadService->detachFile($upload_id);
        }
        elseif(array_key_exists('poster', $data)) {
            if($data['poster'] instanceof UploadedFile) {
                $fileModel = $this->uploadService->getFileService()->saveFile($data['poster']);
                $data['poster_id'] = $fileModel->id;
            }
            unset($data['poster']);
        }
        /** @var User $user */
        $user = $this->getRepository()->createFromArray($data);

        // $this->uploadService->clearCurrent();

        event(new UserEvent($user, UserEvent::STORED));

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function currentUser(): ?User
    {
        /** @var UserRepository $repository */
        $repository = $this->getRepository();
        return $repository->currentUser();
    }
}
