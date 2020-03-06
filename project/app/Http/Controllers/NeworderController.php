<?php
/**
 * Контроллер для создания новых заказов
 *
 */

namespace App\Http\Controllers;

use App\Helpers\XmlResponseHelper;
use App\Models\Deliveryset;
use App\Models\Item;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use SimpleXMLElement;

class NeworderController extends Controller
{
    /**
     *
     *
     */
    public function index(SimpleXMLElement $xmlData)
    {
        $xmlResponseMainElemantName = 'neworder';

        $result = [
            $xmlResponseMainElemantName => []
        ];

        $data['newFolder'] = (strtolower($xmlData->attributes()->newfolder) == 'yes') ? true : false;
        foreach ($xmlData->order as $order) {
            $order = $this->getDataFromOrder($order);
            $orderModel = new Order($order);
            if($orderModel->save()) {
                $orderId = $orderModel->id;
                $result[$xmlResponseMainElemantName][] = [
                    '@value' => 'Success',
                    '@attributes' => [
                        'id' => $orderId,
                        'error' => 0,
                        'errormsg' => ''
                    ]
                ];

                if(isset($order['items'])){
                    foreach ($order['items'] as $item) {
                        $itemModel = new Item($item);
                        $itemModel->order_id = $orderId;
                        $itemModel->save();
                    }
                }
                if(isset($order['packages'])){
                    foreach ($order['packages'] as $package) {
                        $packageModel = new Package($package);
                        $packageModel->order_id = $orderId;
                        $packageModel->save();
                    }
                }
                if(isset($order['deliverysets'])){
                    foreach ($order['deliverysets'] as $deliveryset) {
                        $deliverysetModel = new Deliveryset($deliveryset);
                        $deliverysetModel->order_id = $orderId;
                        $deliverysetModel->save();
                    }
                }
            } else {
                $result[$xmlResponseMainElemantName][] = [
                    '@value' => 'Failed',
                    '@attributes' => [
                        'id' => '',
                        'error' => 3,
                        'errormsg' => 'The creating if new order failed'
                    ]
                ];
            }
        }
        $response = XmlResponseHelper::ParseXMLToArray($result);
        return response($response->asXML(), 200)
            ->header('Content-type', 'application/xml');
    }

    /**
     * Возвращает из заказа нужные данные
     *
     * @param $order \SimpleXMLElement
     * @return array
     */
    private function getDataFromOrder($order)
    {
        $result = [];
        if ($order->attributes()->orderno) $result['orderno'] = (string) $order->attributes()->orderno;
        foreach ($order as $key => $item) {
            $value = trim(strval($item));
            if($value) $result[$key] = $value;
        }

        if($order->receiver){
            $receiver = $order->receiver->children();
            foreach ($receiver as $key => $item) {
                $value = trim(strval($item));
                if($value) $result['receiver_'.$key] = $value;
            }
        }
        if($order->sender){
            $sender = $order->sender->children();
            foreach ($sender as $key => $item) {
                $value = trim(strval($item));
                if($value) $result['sender_'.$key] = $value;
            }
        }

        if($order->items){
            $items = $order->xpath('items/item');
            foreach ($items as $item){
                $itemArray = [];
                $itemArray['title'] = (string) $item;
                foreach ($item->attributes() as $key => $attr){
                    $key = strtolower($key);
                    $itemArray[$key] = (string) $attr;
                }
                $result['items'][] = $itemArray;
            }
        }

        if($order->packages){
            $packages = $order->xpath('packages/package');
            foreach ($packages as $package){
                $packagesArray = [];
                foreach ($package->attributes() as $key => $attr){
                    $key = strtolower($key);
                    $packagesArray[$key] = strval($attr);
                }
                $result['packages'][] = $packagesArray;
            }
        }

        if($order->deliveryset){

            $deliverysetsAttrArray = [];
            $deliverysets = $order->deliveryset;
            foreach ($deliverysets->attributes() as $key => $value) {
                $value = trim(strval($value));
                if ($value) $deliverysetsAttrArray[$key] = $value;
            }

            foreach ($deliverysets->children() as $below) {
                $belowAttrArray = [];
                foreach ($below->attributes() as $key => $value) {
                    $value = trim(strval($value));
                    if ($value) $belowAttrArray[$key] = $value;
                }
                $result['deliverysets'][] = array_merge($deliverysetsAttrArray, $belowAttrArray);
            }
        }

        return $result;
    }
}
