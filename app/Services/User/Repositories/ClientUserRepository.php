<?php


namespace App\Services\User\Repositories;


use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Services\Order\Resources\ClientOrder as ClientOrderResource;
use App\Services\User\Resources\User as UserResource;

class ClientUserRepository
{
    private User $model;

    /**
     * ClientUserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getItem(int $id): User
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param int $id
     * @return UserResource
     */
    public function getResourceItem(int $id): UserResource
    {
        return new UserResource($this->model::findOrFail($id));
    }

    /**
     * @param array $data
     * @param int $role
     * @return User
     */
    public function store(array $data, int $role): User
    {
        $user = $this->model::create($data)
            ->attachRole($role);
        $user->details()->create();

        return $user;
    }

    /**
     * @param string $value
     * @return mixed
     */
    public function updateName(string $value)
    {
        $user = auth()->user();

        return $user->update(['name' => $value]);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|User $user
     * @param string $email
     */
    public function setConfirmToken($user, string $email)
    {
        $user->emailConfirmation()->updateOrCreate(
            ['user_id' => $user->id],
            ['email' => $email, 'token' => sha1(time())]
        );
    }

    /**
     * @param User $user
     * @return bool
     */
    public function emailConfirm(User $user)
    {
        $verifiedEmail = $user->emailConfirmation->email;
        $currentEmail = $user->email;

        if ($verifiedEmail === $currentEmail && $user->confirmed) {
            return false;
        }

        return !!$user->update([
            'email' => $verifiedEmail,
            'confirmed' => 1
        ]);
    }

    /**
     * @param string $token
     * @return mixed
     */
    public function getEmailConfirmation(string $token)
    {
        return $this->model::getEmailConfirmation($token)->first();
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getUserByEmail(string $email)
    {
        return $this->model::where('email', $email)->first();
    }

    /**
     * @param User $user
     * @param string $socialId
     * @param string $service
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function storeUserSocial(User $user, string $socialId, string $service)
    {
        return $user->socials()->create([
            'social_id' => $socialId,
            'service' => $service
        ]);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getUserBySocialId(string $id)
    {
        return $this->model::getUserBySocialId($id)->first();
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|User $user
     * @return mixed
     */
    public function getOrders($user)
    {
        return ClientOrderResource::collection($user->orders()->orderBy('id', 'desc')->get());
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|User $user
     * @param int $number
     * @return mixed
     */
    public function getOrder($user, int $number)
    {
        return new ClientOrderResource(
            $user->orders()
                ->where('number', $number)
                ->firstOrFail()
        );
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|User $user
     * @param int $number
     * @return mixed
     */
    public function cancelOrder($user, int $number)
    {
        /** @var OrderStatus $canceledStatus */
        $canceledStatus = OrderStatus::where('alias', Order::CANCELED_STATUS)->firstOrFail();

        /** @var Order $order */
        $order = $user->orders()->where('number', $number)->firstOrFail();
        $lastOrderStatus = $order->statuses->last();

        $order->statuses()->syncWithoutDetaching([$canceledStatus->id]);

        return new ClientOrderResource($order);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|User $user
     * @param array $items
     * @return mixed
     */
    public function syncLikes($user, array $items)
    {
        $user->likes()->syncWithoutDetaching($items);

        return $user->likes->pluck('id');
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|User $user
     * @param int $imageId
     * @return mixed
     */
    public function toggleLike($user, int $imageId)
    {
        $user->likes()->toggle([$imageId]);

        return $user->likes->pluck('id');
    }
}
