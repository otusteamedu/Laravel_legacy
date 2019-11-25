<?php


namespace App\Repositories;

use App\Base\Repository\BaseRepository;
use App\Base\WrongNamespaceException;
use App\Repositories\Files\IFileRepository;
use App\Repositories\Interfaces\IUploadRepository;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use Carbon\Carbon;

class UploadRepository extends BaseRepository implements IUploadRepository
{
    const TIME_TO_LIVE = 2 * 24 * 3600;

    private $userRepository;
    private $fileRepository;

    public function __construct(
        IUserRepository $userRepository,
        IFileRepository $fileRepository
    ) {
        parent::__construct();

        $this->userRepository = $userRepository;
        $this->fileRepository = $fileRepository;
    }
    /**
     * @param array $data
     * @return Model
     * @throws WrongNamespaceException
     */
    public function createFromArray(array $data): Model {
        /** @var $movie Upload */
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        $upload = parent::createFromArray($data);
        $user = null;
        if(!isset($data['user_id']))
            $user = $this->userRepository->currentUser();
        elseif($data['user_id'] > 0)
            $user = $this->userRepository->getByPrimary($data['user_id']);

        if($user)
            $upload->owner()->associate($user);

        $upload->file()->associate(
            $this->fileRepository->find($data['file_id'])
        );

        $upload->push();

        return $upload;
    }
    public function updateFromArray(Model $model, array $data): Model {
        $data['updated_at'] = Carbon::now();
        if(array_key_exists('session_id', $data))
            unset($data['session_id']);
        if(array_key_exists('file_id', $data))
            unset($data['file_id']);
        if(array_key_exists('user_id', $data))
            unset($data['user_id']);
        if(array_key_exists('field', $data))
            unset($data['field']);
        if(array_key_exists('url', $data))
            unset($data['url']);

        return parent::updateFromArray($model, $data);
    }
    /**
     * @return Collection
     * @throws WrongNamespaceException
     */
    public function getOldUploads(): Collection {
        $model = $this->getModel();

        return $model->newQuery()->whereIn('session_id',
            function($query) use ($model) {
                /** @var \Illuminate\Database\Query\Builder $query */
                $query->select('session_id')
                    ->from($model->getTable())
                    ->leftJoin('users', $model->getTable() . '.user_id', '=', 'users.id')
                    ->where('updated_at', '<', Carbon::now()->subSeconds(self::TIME_TO_LIVE))
                    ->orWhere(function($query) use ($model) {
                        /** @var \Illuminate\Database\Query\Builder $query */
                        $query->where($model->getTable() . '.user_id' > 0)->whereNull('users.id');
                    })
                    ->groupBy('session_id');
            }
        )->get();
    }

    /**
     * @param string $path
     * @param string $session_id
     * @param string $user_id
     * @return Collection
     * @throws WrongNamespaceException
     */
    public function getUploads(string $path, string $session_id, int $user_id = 0) : Collection {
        if(empty($session_id) && !$user_id)
            return new Collection();

        return $this->getModel()->newQuery()
            ->where('url', '=', $path)
            //   ->where('field', '=', $field)
            ->where(function($query) use ($session_id, $user_id) {
                /** @var \Illuminate\Database\Query\Builder $query */
                $query->where('session_id', '=', $session_id);
                if($user_id > 0) {
                    $query->orWhere( 'user_id', '=', $user_id);
                }
            })->get();
    }
    /**
     * @param string $path
     * @param string $session_id
     * @param int $user_id
     * @return array
     * @throws WrongNamespaceException
     */
    public function getByFieldsUploads(string $path , string $session_id , int $user_id = 0): array
    {
        $result = [];
        $fileCollection = $this->getUploads($path, $session_id, $user_id);
        /** @var Upload $item */
        foreach ($fileCollection as $item) {
            if(!array_key_exists($item->field, $result))
                $result[$item->field] = [];

            $result[$item->field][] = $item;
        }

        return $result;
    }

    public function getNewSort(string $path, string $field): int {
        return 10;
    }
}
