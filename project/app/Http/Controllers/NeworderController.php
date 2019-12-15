<?php
/**
 * Контроллер для создания новых заказов
 *
 */

namespace App\Http\Controllers;

use App\Models\Order;
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
        $data = [];

        $data['newFolder'] = (strtolower($xmlData->attributes()->newfolder) == 'yes') ? true : false;
        foreach ($xmlData->order as $order) {
            $order = $this->getDataFromOrder($order);

            $orderModel = new Order($order);
            $orderModel->save();
        }


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
