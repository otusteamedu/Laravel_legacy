0. исходный код

```php
<?php


namespace Toledo\Controller;

use Toledo\Lib\Controller;
use Toledo\Lib\Slack\Client;
use Toledo\Module\Basket\Collection\BasketCollection;
use Toledo\Module\Basket\Entity\BasketEntity;
use Toledo\Module\Basket\Service\BasketService;
use Toledo\Module\SVT\Service\LtCompanyService;
use Toledo\Module\SVT;
use GuzzleHttp;
use Toledo\Module\SVT\Enum;


class ApiController extends Controller
{

    public function getOrderST()
    {
        $httpContent = $this->getRequest()->getContent();
        if ($httpContent->getMethod() == 'GET') {

            $get = $httpContent->getRequestData();
            //пробуем получить заказ из таблицы
            if(isset($get['lt_order_id'])) {
                $ltService = new LtCompanyService();
                //если заказ существует, то достаем подробную информацию
                if($ltService->orderExist($get['lt_order_id']) === true) {

                    //заполняем fuser
                    if(isset($_SESSION['SALE_USER_ID'])) {
                        $ltService->orderSetFuser($get['lt_order_id'], $_SESSION['SALE_USER_ID']);
                    } else {
                        $_SESSION['lt_order_id'] = $get['lt_order_id'];
                    }

                    $goods = $ltService->getOrderGoods($get['lt_order_id']);
                    $LtCompanyOrderEntity = $ltService->getOrderData($get['lt_order_id']);

                    $sum = 0;
                    $collection = new BasketCollection();
                    $basketEntity = new BasketEntity();
                    foreach ($goods as $good) {
                        $basketEntity = $basketEntity->fromArray($good->toArray());
                        $collection->add($basketEntity);
                        $sum += $good->getSum();
                    }
                    unset($good);
                    $isAddedToBasket = BasketService::addToBasket($collection);
                    if ($isAddedToBasket !== null) {

                        $responseData['data'] = [
                            "distrib_order_id"=> $LtCompanyOrderEntity->getTempOrderId(),
                            "lt_order_id" =>  $LtCompanyOrderEntity->getOrderId(),
                            "status" => "PROCESSED",
                            "distr_summ" => $sum,
                            "api_key" => Enum::API_KEY
                        ];
                        $client = new GuzzleHttp\Client();
                        try {
                            $client->request('POST', Enum::REPORT_URI,
                                ['body' =>  json_encode($responseData,JSON_UNESCAPED_UNICODE)]
                            );
                        } catch (\Exception $exception) {
                            $slack = new Client();
                            $slack->attach([
                                'fallback' => ' ',
                                'text' => 'При попытке отправить отчет о заказе в Световые технологии',
                                'color' => 'danger',
                                'fields' => [
                                    [
                                        'title' => 'ошибка',
                                        'value' => $exception->getMessage(),
                                        'short' => false
                                    ],
                                    [
                                        'title' => 'uri',
                                        'value' => Enum::REPORT_URI,
                                        'short' => false
                                    ],
                                    [
                                        'title' => 'данные',
                                        'value' => var_export($responseData, true),
                                        'short' => false
                                    ]
                                ]
                            ])->send('');
                        }

                        LocalRedirect("/order/");
                    } else {
                        LocalRedirect("/");
                    }
                }
            }

        } elseif ($httpContent->getMethod() == 'POST') {
            $bodyRequest = json_decode($httpContent->getBody(), JSON_OBJECT_AS_ARRAY);
            if ($bodyRequest["api_key"] == SVT\Enum::API_KEY) {

                $ltService = new LtCompanyService();
                $goods = $ltService->getGoodsFromStRequest($bodyRequest);
                $isOrderSaved = $ltService->saveOrder(
                    $bodyRequest['lt_order_id'],
                    $bodyRequest['lt_user_name'],
                    $bodyRequest['lt_user_phone'],
                    $bodyRequest['lt_user_email']
                );

                $isGoodsSaved = $ltService->saveGoods($goods);
                if ($isOrderSaved == false || $isGoodsSaved == false) {
                    throw new \Exception('Не удалось записать данные заказа от Световых технологий');
                }

            } else {
                LocalRedirect("/");
            }
        }
    }
}
```

1. пытаемся сделать код более читаемым для того чтобы можно было уже разобрать структуру и логику
    - ветки условий с большим количеством кода на первом этапе разделяем на отдельные приватные методы, впоследствии будет видно - если ли необходимость в объединять две ветки условия в один метод, или есть необходимость сделать 2 отдельные точки входа
    - множественные ветвления заменяем на ранний возврат, перед строками с ранним возвратом делаем отступ, в соответствии с CC
    - заменяю часть служебных выводов (отправка дебага в slack) комментарием, чтобы на время рефакторинга сократьить количество кода и повысить читаемость
```php
<?php


namespace Toledo\Controller;

use Toledo\Lib\Controller;
use Toledo\Lib\Slack\Client;
use Toledo\Module\Basket\Collection\BasketCollection;
use Toledo\Module\Basket\Entity\BasketEntity;
use Toledo\Module\Basket\Service\BasketService;
use Toledo\Module\SVT\Service\LtCompanyService;
use Toledo\Module\SVT;
use GuzzleHttp;
use Toledo\Module\SVT\Enum;


class ApiController extends Controller
{

    public function getOrderST()
    {
        $httpContent = $this->getRequest()->getContent();
        if ($httpContent->getMethod() == 'GET') {
            $this->forGet();
        } elseif ($httpContent->getMethod() == 'POST') {
            $this->forPost();
        }
    }

    private function forPost()
    {
        $httpContent = $this->getRequest()->getContent();
        $bodyRequest = json_decode($httpContent->getBody(), JSON_OBJECT_AS_ARRAY);

        if ((string) $bodyRequest["api_key"] !== SVT\Enum::API_KEY) LocalRedirect("/");
        $ltService = new LtCompanyService();
        $goods = $ltService->getGoodsFromStRequest($bodyRequest);
        $isOrderSaved = $ltService->saveOrder(
            $bodyRequest['lt_order_id'],
            $bodyRequest['lt_user_name'],
            $bodyRequest['lt_user_phone'],
            $bodyRequest['lt_user_email']
        );

        $isGoodsSaved = $ltService->saveGoods($goods);
        if ($isOrderSaved == false || $isGoodsSaved == false) {
            throw new \Exception('Не удалось записать данные заказа от Световых технологий');
        }
    }

    private function forGet() {
        $httpContent = $this->getRequest()->getContent();
        $get = $httpContent->getRequestData();
        
        if($get['lt_order_id'] === null) return;
        $ltService = new LtCompanyService();
       
        if($ltService->orderExist($get['lt_order_id']) !== true) return;
        //если заказ существует - достаем подробную информацию 
        if(isset($_SESSION['SALE_USER_ID'])) {
            $ltService->orderSetFuser($get['lt_order_id'], $_SESSION['SALE_USER_ID']);
        } else {
            $_SESSION['lt_order_id'] = $get['lt_order_id'];
        }
        $goods = $ltService->getOrderGoods($get['lt_order_id']);
        $LtCompanyOrderEntity = $ltService->getOrderData($get['lt_order_id']);
        $sum = 0;
        $collection = new BasketCollection();
        $basketEntity = new BasketEntity();
        foreach ($goods as $good) {
            $basketEntity = $basketEntity->fromArray($good->toArray());
            $collection->add($basketEntity);
            $sum += $good->getSum();
        }
        unset($good);
        $isAddedToBasket = BasketService::addToBasket($collection);
    
        if ($isAddedToBasket === null) LocalRedirect("/");
        $responseData['data'] = [
            "distrib_order_id"=> $LtCompanyOrderEntity->getTempOrderId(),
            "lt_order_id" =>  $LtCompanyOrderEntity->getOrderId(),
            "status" => "PROCESSED",
            "distr_summ" => $sum,
            "api_key" => Enum::API_KEY
        ];
        $client = new GuzzleHttp\Client();
        try {
            $client->request(
                'POST',
                Enum::REPORT_URI,
                [
                    'body' =>  json_encode($responseData,JSON_UNESCAPED_UNICODE)
                ]
            );
        } catch (\Exception $exception) {
            //@todo: вернуть debug в слак
        }
        
        LocalRedirect("/order/");
    }

}
```


3. разбираем явные наружения договоренностей и излишние действия
    - нет необходимости мапинга и создания BasketEntity, т.к. BasketService::addToBasket принимает на вход GoodCollection  
    - нет необходимости писать реализацию подсчета общей суммы товаров, т.к. она доступна к коллекции товаров (паттерн компоновщик)
    - нет необходимости писать дебаг в слак, т.к. для BasketService уже написан отладчик, тесты и исключительные поведения
    - при возможности отделить реализацию GET и POST запросов на разные методы, сделать названия методов читаемыми в соответствии с правилами именования 
```php
<?php


namespace Toledo\Controller;

use Toledo\Lib\Controller;
use Toledo\Lib\Slack\Client;
use Toledo\Module\Basket\Collection\BasketCollection;
use Toledo\Module\Basket\Entity\BasketEntity;
use Toledo\Module\Basket\Service\BasketService;
use Toledo\Module\SVT\Service\LtCompanyService;
use Toledo\Module\SVT;
use GuzzleHttp;
use Toledo\Module\SVT\Enum;


class ApiController extends Controller
{

    public function getOrderST()
    {
        $httpContent = $this->getRequest()->getContent();
        if ($httpContent->getMethod() == 'GET') {
            $this->forGet();
        } elseif ($httpContent->getMethod() == 'POST') {
            $this->forPost();
        }
    }

    private function forPost()
    {
        $httpContent = $this->getRequest()->getContent();
        $bodyRequest = json_decode($httpContent->getBody(), JSON_OBJECT_AS_ARRAY);

        if ((string) $bodyRequest["api_key"] !== SVT\Enum::API_KEY) LocalRedirect("/");
        $ltService = new LtCompanyService();
        $goods = $ltService->getGoodsFromStRequest($bodyRequest);
        $isOrderSaved = $ltService->saveOrder(
            $bodyRequest['lt_order_id'],
            $bodyRequest['lt_user_name'],
            $bodyRequest['lt_user_phone'],
            $bodyRequest['lt_user_email']
        );

        $isGoodsSaved = $ltService->saveGoods($goods);
        if ($isOrderSaved == false || $isGoodsSaved == false) {
            throw new \Exception('Не удалось записать данные заказа от Световых технологий');
        }
    }

    private function forGet() {
        $httpContent = $this->getRequest()->getContent();
        $get = $httpContent->getRequestData();
        
        if($get['lt_order_id'] === null) return;
        $ltService = new LtCompanyService();
       
        if($ltService->orderExist($get['lt_order_id']) !== true) return;
        //если заказ существует - достаем подробную информацию
        /**
        * неявные действия, на данном уровне абстракции мы не знаем о том что такое сессия 
        */
        if(isset($_SESSION['SALE_USER_ID'])) {
            $ltService->orderSetFuser($get['lt_order_id'], $_SESSION['SALE_USER_ID']);
        } else {
            $_SESSION['lt_order_id'] = $get['lt_order_id'];
        }
        
        try {
            $goodsCollection = $ltService->getOrderGoods($get['lt_order_id']);
            BasketService::addToBasket($goodsCollection);
    
            $responseData['data'] = [
                "distrib_order_id"=> $ltService->getOrderId(),
                "lt_order_id" =>  $get['lt_order_id'],
                "status" => "PROCESSED",
                "distr_summ" => $goodsCollection->getSum() ?? 0,
                "api_key" => Enum::API_KEY
            ];

            (new GuzzleHttp\Client())->request(
                'POST',
                Enum::REPORT_URI,
                [
                    'body' =>  json_encode($responseData,JSON_UNESCAPED_UNICODE)
                ]
            );

            LocalRedirect("/order/");

        } catch (Exception $exception) {
            LocalRedirect("/");
        }
        
    }

}
```