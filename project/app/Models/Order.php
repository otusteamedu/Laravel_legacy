<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'client_id',
        'address_id',
        'status',
        'orderno',
        'return',
        'weight',
        'return_weight',
        'quantity',
        'paytype',
        'service',
        'return_service',
        'type',
        'return_type',
        'price',
        'deliveryprice',
        'inshprice',
        'enclosure',
        'receiverpays',
        'enclosure',
        'instruction',
        'department',
        'pickup',
        'acceptpartially',
        'sender_company',
        'sender_person',
        'sender_phone',
        'sender_town',
        'sender_address',
        'sender_date',
        'sender_time_min',
        'sender_time_max',
        'receiver_company',
        'receiver_person',
        'receiver_phone',
        'receiver_zipcode',
        'receiver_town',
        'receiver_address',
        'receiver_pvz',
        'receiver_date',
        'receiver_time_min',
        'receiver_time_max',
        'created_at',
        'updated_at',
        'is_shown',
        'is_committed'
    ];

    /**
     * Устанавливает статус is_committed активным просмотренным (поле is_shown) заказам для клиента, id которого передано
     * в качестве параметра
     *
     * @param $clientId string
     * @return bool
     */
    public static function commitOrdersByClientId($clientId)
    {
        $result = OrderModel::where('client_id', '=', $clientId)
            ->where('is_shown', '=', 1)
            ->whereNotIn('status', [9, 12])
            ->update(['is_committed' => 1]);
        return (bool)$result;
    }

    /**
     * Возвращает массив активных заказов, в которых были изменения с момента последнего запроса only_last
     * (после изменения столбец is_commited=0 (т.е пользователь, не подтвердил(не закоммитил) это изменение специальным
     * запросом commitlaststatus))
     *
     * @return array
     */
    public static function getOrdersIdsForOnlyLastRequest($clientCode)
    {
        $ids = [];
        $list = OrderModel::whereNotIn('status', [9, 12])
            ->select('address_id')
            ->where('is_committed', '=', 0)
            ->where('client_id', '=', $clientCode)
            ->get();
        foreach ($list as $order) {
            $ids[] = $order['address_id'];
        }
        return $ids;
    }

    /**
     * Отмечает заказы, id которых переданы, как "показанные"(столбец isShown)
     *
     * @param $ordersIds array
     * @return bool
     */
    public static function markOrdersAsShown($ordersIds)
    {
        $result = OrderModel::whereIn('address_id', $ordersIds)
            ->update(['is_shown' => 1]);
        return $result;
    }
}