<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const STATUS_ACCEPTED = 'Accepted';
	const STATUS_NEW = 'New';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'phone', 'company'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * Get the orders connected with the user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function publish(Order $order)
	{
		$this->orders()->save($order);
	}

	public static function statusList()
	{
		return [
			'New' => 'Новый',
			'Accepted' => 'Принято',
			'Canceled' => 'Отклонено',
		];
	}

	public function getStatusName()
	{
		return isset(self::statusList()[$this->status]) ? self::statusList()[$this->status] : '';
	}

	public function IsManager()
	{
		return $this->is_manager ?: false;
	}

	public static function getEmailByPhone($phone)
	{
		if ($phone) {
			$user = User::where('phone', $phone)->first();
			if ($user)
				return $user->toArray()['email'];
		} else
			return false;
	}
}
