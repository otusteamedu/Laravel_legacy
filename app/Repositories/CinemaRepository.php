<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Helpers\Views\AdminHelpers;
use App\Models\Cinema;
use App\Models\User;
use App\Repositories\Files\IFileRepository;
use App\Repositories\Interfaces\ICinemaRepository;
use App\Repositories\Interfaces\IUserRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CinemaRepository extends BaseRepository implements ICinemaRepository
{
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

    public function makeRelations(Cinema $cinema, array $data): Model {
        if(array_key_exists('created_user_id', $data)) {
            if($data['created_user_id'] > 0) {
                $user = $this->userRepository->getByPrimary($data['created_user_id']);
                $cinema->owner()->associate($user);
            }
            elseif($cinema->created_user_id)
                $cinema->owner()->dissociate();
        }
        if(array_key_exists('photos_id', $data) && is_array($data['photos_id'])) {
            $photos_id = [];
            $old_photos_id = $cinema->photos->pluck('id')->toArray();
            foreach ($data['photos_id'] as $photo_id) {
                $photo = $this->fileRepository->find($photo_id);
                if($photo) {
                    $bCreate = !in_array($photo_id, $old_photos_id);
                    $photos_id[$photo_id] = AdminHelpers::DbTimeStamps($bCreate);
                }
            }
            $cinema->photos()->sync($photos_id);
        }
        $cinema->push();

        return $cinema;
    }
    /**
     * @param array $data
     * @return Model
     * @throws \App\Base\WrongNamespaceException
     */
    public function createFromArray(array $data): Model {
        //$data
        $data['updated_at'] = Carbon::now();
        $data['created_at'] = Carbon::now();

        if(!array_key_exists('created_user_id', $data)) {
            /** @var User $user */
            $user = $this->userRepository->currentUser();
            $data['created_user_id'] = $user->id;
        }
        /** @var $cinema Cinema */
        $cinema = parent::createFromArray($data);
        $cinema = $this->makeRelations($cinema, $data);

        return $cinema;
    }
}
