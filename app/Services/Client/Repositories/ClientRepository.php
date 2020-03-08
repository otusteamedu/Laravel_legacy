<?php


namespace App\Services\Client\Repositories;


use App\Models\ClientInformation;
use App\Models\User;
use App\Models\UserGroup;
use App\Services\UserGroup\UserGroupRepositoryInterface;
use App\Services\UserGroup\UserGroupService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class ClientRepository implements ClientRepositoryInterface
{
    protected const PAGINATE = 10;

    /**
     * @inheritDoc
     */
    public function getById(int $clientId): User
    {
        return User::whereId($clientId)
            ->with('clientInformation')
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function getPaginationList(int $masterId = 0): LengthAwarePaginator
    {
        return $masterId > 0 ? $this->masterClients($masterId) : $this->clients();
    }

    /**
     * @inheritDoc
     */
    public function save(User $client)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param int $masterId
     * @return LengthAwarePaginator
     */
    protected function masterClients(int $masterId): LengthAwarePaginator
    {
        return User::findOrFail($masterId)
            ->clients()
            ->paginate(self::PAGINATE);
    }

    /**
     * @return LengthAwarePaginator
     */
    protected function clients(): LengthAwarePaginator
    {
        return User::whereHas('group', static function ($query) {
            /** @var BelongsTo $query */
            $query->where('code', UserGroup::CLIENT_CODE);
        })->paginate(self::PAGINATE);
    }

    /**
     * @inheritDoc
     */
    public function getList(int $masterId): Collection
    {
        return User::findOrFail($masterId)
            ->clients()
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function create(int $masterId, array $userData): ?User
    {
        $groupService = app(UserGroupService::class);

        $user = new User();
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->phone_number = $userData['phone_number'];
        $user->email = $userData['email'];
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->group_id = $groupService->getIdByCode(UserGroupRepositoryInterface::CLIENT_GROUP_CODE);

        $user->save();

        $clientInformation = new ClientInformation();
        $clientInformation->material = $userData['material'];
        $clientInformation->note = $userData['note'];

        $user->clientInformation()->save($clientInformation);

        return $user === false ? null : $user;
    }

    /**
     * @inheritDoc
     */
    public function getLastUserId(): int
    {
        /** @var User $user */
        $user = User::orderBy('id', 'desc')
            ->first();

        return $user->id;
    }
}
