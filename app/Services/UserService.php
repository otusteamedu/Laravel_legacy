<?php


namespace App\Services;


use App\Base\Service\BaseService;
use App\Base\Service\Q;
use App\Events\UserEvent;
use App\Helpers\Views\AdminHelpers;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\UserRepository;
use App\Services\Exceptions\UserException;
use App\Services\Interfaces\IUploadService;
use App\Services\Interfaces\IUserService;
use Illuminate\Support\Facades\Hash;
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
        if(isset($uploads['file']) && count($uploads['file'])) {
            $upload_id = $uploads['file'][0]['id'];
            $data['file_id'] = $this->uploadService->detachFile($upload_id);
        }
        elseif(array_key_exists('file', $data)) {
            if($data['file'] instanceof UploadedFile) {
                $fileModel = $this->uploadService->getFileService()->saveFile($data['file']);
                $data['file_id'] = $fileModel->id;
            }
            unset($data['file']);
        }
        /** @var User $user */
        $user = $this->getRepository()->createFromArray($data);

        $this->uploadService->clearCurrent();

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
    private function validateQuickRegister(array $data) {
        $this->validateQuickRegisterData($data);
        $ex = new UserException;
        if(!AdminHelpers::normalizePhone($data['phone']))
            $ex->add(__('errors.users.phone_format'));
        if($this->findByPhone($data['phone']))
            $ex->add(__('errors.users.phone_exists'));
        if($this->findByEmail($data['email']))
            $ex->add(__('errors.users.email_exists'));
        $ex->assert();
    }

    private function validateQuickRegisterData(array $data) {
        \Illuminate\Support\Facades\Validator::make($data, [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
        ], [
            'name.required' => __('errors.required', ['field' => __('public.user.name')]),
            'email.required' => __('errors.required', ['field' => __('public.user.email')]),
            'phone.required' => __('errors.required', ['field' => __('public.user.phone')])
        ])->validate();
    }

    public function quickRegister(array $data): User
    {
        $this->validateQuickRegister($data);

        /** @var IUserRepository $repository */
        $repository = $this->getRepository();
        $data['active'] = true;
        $data['password_raw'] = AdminHelpers::generatePassword();
        $data['password'] = Hash::make($data['password_raw']);
        /** @var User $user */
        $user = $repository->createFromArray($data);

        event(new UserEvent($user, UserEvent::STORED, $data));

        return $user;
    }

    public function findByEmail(string $value): ?User
    {
        /** @var UserRepository $repository */
        $repository = $this->getRepository();
        /** @var User $user */
        $user = $repository->getList(new Q(['email' => $value, 'email_exact' => true]))->first();
        return $user ?? null;
    }

    public function findByPhone(string $value): ?User
    {
        /** @var UserRepository $repository */
        $repository = $this->getRepository();
        /** @var User $user */
        $user = $repository->getList(new Q(['phone' => $value]))->first();
        return $user ?? null;
    }
}
