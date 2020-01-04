<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
		'customer_name',
		'customer_phone',
		'research_area',
		'comment',
		'status',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public static function statusList()
	{
		return [
			'New' => 'Новая',
			'Client came' => 'Пациент пришел',
			'Waiting' => 'Ожидаем пациента',
			'Canceled' => 'Заявка отклонена',
		];
	}

	public function getStatusName()
	{
		return isset(self::statusList()[$this->status]) ? self::statusList()[$this->status] : '';
	}

}
