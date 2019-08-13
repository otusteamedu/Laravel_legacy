# Домашняя работы №2

### Код написаный до урока нашел, но местами что изучали на уроке, уже учтено

Пример интерфейса, который был написан еще в 2015 году
Проект все еще работет, но требует доработки.

```php
interface HotelDriverInterface
{

    /**
     * Поис отелей по локации
     * @param SearchHotelRequest $request
     * @return SearchHotel[]
     */
    public function searchHotelByLocation(SearchHotelRequest $request);

    /**
     * Возвращает варианты номеров в наденом отеле
     * @param SearchRateRequest $request
     * @return SearchRateResponse
     */
    public function searchVariantsByHotel(SearchRateRequest $request);

    /**
     * На данный момент не используется
     * @param \DateTime $dateIn
     * @param \DateTime $dateOut
     * @param $hotel
     * @param $rooms
     * @return mixed
     */
    public function loadVariantDetail(\DateTime $dateIn, \DateTime $dateOut, $hotel, $rooms);

    /**
     * Создание заказа на стороне системы бронирования
     * @param BookingOrderRequest $request
     * @return string - номер заказа на стороне поставщика
     * @throws DriverException
     */
    public function createBooking(BookingOrderRequest $request);

    /**
     * Отмена бронирования
     * @param OrderRequest $request
     * @return OrderCancelInfo
     */
    public function cancelBooking(OrderRequest $request);


    /**
     * Получить информацию о бронрование
     * @param OrderRequest $request
     * @return OrderResponse
     * @throws DriverException
     */
    public function loadBooking(OrderRequest $request);

    /**
     * Выписка бронирвания у поставщика, пока не используется, т.к. нет поставщиков требующих данную операцию
     * @param $reference
     * @return mixed
     */
    public function issueBooking($reference);

    /**
     * Загрузка изображние от поставщика, не использоуется, было актуально для ПБ, может в будущем если будем замыкать
     * все изобрадения на свои сревера, то пригодится
     * @param $imageIds
     * @return mixed
     */
    public function getHotelImage($imageIds);

    /**
     * Получение более точной информации о бронируемых номерах, в частности для -----
     * будет возврщена более точная информация о штрафах, причем данная функция посути и нужна
     * только для -----
     * В предверии работы с ранним/позним заездом, возможно эта же функция будет использоваться для получения
     * информации о цене раннего/позденего заезда, точнее об измении цены заказа в связи с другим временем заезда/выезда
     *
     * @param PricingRequest $request
     * @return PricingResponse
     */
    public function variantPricing(PricingRequest $request);

    /**
     * Получить последний полученный ответ от поставщика
     * @return array|string
     */
    public function getLastResponse();

    /**
     * Получить последний отпарвленный запрос к поставщику
     * @return array|string
     */
    public function getLastRequest();

    /**
     * Получить список обязательных данных для бронирования,
     * каждая система бронирования выбирает из приведнно списка поля обязательные для заполнения
     * и при запросе pricingRequest эти данные передаются клиенту для формирования формаы бронирования
     * 'FIRST_NAME', - имя гостя
     * 'SECOND_NAME', - фамилия гостя
     * 'TITLE', - пол М/Ж
     * 'CHILD_BIRTH_DATE' - день рождение ребенка
     * 'ADULT_BIRTH_DATE' - день рождение гостя
     * @return array - ['FIRST_NAME', 'SECOND_NAME']
     */
    public function getMandatoryFields();

    /**
     * Есть ли поддержка поиска и бронирования нескольких номеров,
     * @return boolean
     */
    public function isManyRooms();

    /**
     * Возвращает имя драйвера, для чего не помню????
     * примеры -----, Acase, ...
     * @return string
     */
    public function getDriverName();

    /**
     * Получить информацию из токена
     * @param $token
     * @return array
     */
    public function getInfoFromToken($token);

    /**
     * Функция создания Hash для массива variantToken
     * используется для сопоставления pricingRequest запросов с созданым заказом
     * @param array $variantToken
     * @return mixed
     */
    static public function generatePricingHash(array $variantToken);

    /**
     * Функция возвращает информацию о расположении отеля
     * @param $hotelId - индетификатор отлея в системе бронирования
     * @return array
     */
    public function getHotelLocationInfo($hotelId);

    /**
     * @return ProviderSettingInterface
     */
    public function getProvider();
}
```

Данный интерфейс я бы разбил на несколько частей

```php
interface SearchDriverInterface {
    /**
     * Поис отелей по локации
     * @param SearchHotelRequest $request
     * @return SearchHotel[]
     */
    public function searchHotelByLocation(SearchHotelRequest $request);

    /**
     * Возвращает варианты номеров в наденом отеле
     * @param SearchRateRequest $request
     * @return SearchRateResponse
     */
    public function searchVariantsByHotel(SearchRateRequest $request);
}

/**
 * можно даже без реализации метода, если есть интерфейс значит
 * есть возможность бронирование несколько номеров
 */
interface ManyRoomInterface {
    /** 
     * Есть ли поддержка поиска и бронирования нескольких номеров,
     * @return boolean
     */
    public function isManyRooms();
}

interface BookingDriverInterface {
    /**
     * Получение более точной информации о бронируемых номерах, в частности для -----
     * будет возврщена более точная информация о штрафах, причем данная функция посути и нужна
     * только для -----
     * В предверии работы с ранним/позним заездом, возможно эта же функция будет использоваться для получения
     * информации о цене раннего/позденего заезда, точнее об измении цены заказа в связи с другим временем заезда/выезда
     *
     * @param PricingRequest $request
     * @return PricingResponse
     */
    public function variantPricing(PricingRequest $request);

    /**
         * Получить список обязательных данных для бронирования,
         * каждая система бронирования выбирает из приведнно списка поля обязательные для заполнения
         * и при запросе pricingRequest эти данные передаются клиенту для формирования формаы бронирования
         * 'FIRST_NAME', - имя гостя
         * 'SECOND_NAME', - фамилия гостя
         * 'TITLE', - пол М/Ж
         * 'CHILD_BIRTH_DATE' - день рождение ребенка
         * 'ADULT_BIRTH_DATE' - день рождение гостя
         * @return array - ['FIRST_NAME', 'SECOND_NAME']
         */
        public function getMandatoryFields();
    /**
     * Создание заказа на стороне системы бронирования
     * @param BookingOrderRequest $request
     * @return string - номер заказа на стороне поставщика
     * @throws DriverException
     */
    public function createBooking(BookingOrderRequest $request);

}

interface OrderDriverInterface {
        /**
         * Отмена бронирования
         * @param OrderRequest $request
         * @return OrderCancelInfo
         */
        public function cancelBooking(OrderRequest $request);
    
    
        /**
         * Получить информацию о бронрование
         * @param OrderRequest $request
         * @return OrderResponse
         * @throws DriverException
         */
        public function loadBooking(OrderRequest $request);
    
        /**
         * Выписка бронирвания у поставщика, пока не используется, т.к. нет поставщиков требующих данную операцию
         * @param $reference
         * @return mixed
         */
        public function issueBooking($reference);
}
```

есть методы которые из интерфейса перекочевали в абстрактный класс, т.к. 
их реализация не чем не отличалась от провайдера к провайдеру:

```php
abstract class HotelDriverAbstract {
        /**
         * Возвращает имя драйвера, для чего не помню????
         * примеры -----, Acase, ...
         * @return string
         */
        public function getDriverName();
    
        /**
         * Получить информацию из токена
         * @param $token
         * @return array
         */
        public function getInfoFromToken($token);
    
        /**
         * Функция создания Hash для массива variantToken
         * используется для сопоставления pricingRequest запросов с созданым заказом
         * @param array $variantToken
         * @return mixed
         */
        static public function generatePricingHash(array $variantToken);
        /**
         * Получить последний полученный ответ от поставщика
         * @return array|string
         */
        public function getLastResponse();
    
        /**
         * Получить последний отпарвленный запрос к поставщику
         * @return array|string
         */
        public function getLastRequest();
}
```

Способ разбивки был использован в следующем проекте, это был единый шлюз 
работы с разными поставщиками бронирования билетов РЖД.

Также нашел, вот такой пример:

```php
class ApiSearch
{
    protected $db;
    protected $container;
    protected $client;

    public function __construct($host)
    {
        $this->client = new Client(
            [
                'base_uri' => 'https://' . $host . '/engine/v1/',
                'debug' => false,
                'verify' => false,
                'ssl_key' => __DIR__ . '/../../../cert/cacert.pem',
                'http_errors' => true,
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);
    }
}

```
В данном примере клиента надо бы завести через DI, 
что позволит подменить на другую реализацию клиента.
Хотя: GUZZLE рулит

```php
class ApiSearch
{
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
```

Есть еще пример кода, в данном случае для упрощения задачи, класс SearchHotelRequest
сам себя создаёт и наполняет данными, верно это или нет я так и не определился, но данный 
способ был очень хорошо принят у нас на работе и расползся по проектам

```php
class ApiSearch
{
    ...
    public function hotelList(
        Request $request,
        Response $response,
        SearchValidator $validator,
        Auth $auth,
        AccountSettingRepository $settingRepository
    ) {

        if (!$validator->validate($request)) {
            return $response->withJson($validator->getError(), 500);
        }

        $searchHotelRequest = SearchHotelRequest::mapper($validator->get());
    
        ...
    }
    ...
}
```

Он также реализует интерфейс JsonSerializable, что позволяет отдавать эти объекты в response 
и на выходе получаем json

Понятно что в данном случае у данных классов, а потом объектов слишком много ответственности, но
ведь они не сами себя стоят, а через стороннюю зависимость, зависимость интегрирована в статический метод.

Что бы я поменял, если честно ничего, я за два года несколько раз возвращался и пытался его 
привести к некому "каноническому" виду, но все время упирался в те или иные недостатки

Вот за счет чего он заполняется, сам себе создатель: 

```php
abstract class ElementAbstract implements \JsonSerializable
{
    /**
     * @param array|object $json
     * @param object|null $object
     * @return static
     */
    public static function mapper($json, $object = null)
    {
        /** @var static $object */
        $object = self::getInstanceMapper()->map($json, $object ?: new static());

        return $object;
    }

    /**
     * @param array $json
     * @return static[]
     */
    public static function mapArray($json)
    {
        return self::getInstanceMapper()->mapArray($json, array(), static::class);
    }

    /**
     * @return \JsonMapper
     */
    private static function getInstanceMapper()
    {
        static $instance;

        if($instance !== null) return $instance;

        $instance = new \JsonMapper();
        $instance->classMap = [
            '\DateTimeInterface' => '\DateTimeElement'
        ];
        $instance->bEnforceMapType = false;
        $instance->bStrictNullTypes = false;

        return $instance;
    }
    ...
}
```

Также в коде очень есть толстые контейнеры, но это не в рамках данного ДЗ

Вот также нашел немного кода 2017 года и текущий формат

```php
/**
 * Class CompleteController
 * @see AutoCompleteMiddleware
 * @package EngineBundle\Controller
 */
class CompleteController
{
    public function hotelSearchAction(Request $request, Response $response, DatabaseManager $manager)
    {
        $requestData = array_replace(
            ['term' => '', 'limit' => 10],
            $request->getAttribute('data', [])
        );
        $term = $requestData['term'];
        $limit = (int)$requestData['limit'] ?: 10;

        $terms = preg_split('/\s+/', $term);
        array_filter($terms, 'trim');
        $term2 = $terms[0];
        foreach ($terms as &$term){
            if(Str::length($term) > 2){
                $term = sprintf('+(%s|%s)', $term.'*', $this->swithLayout($term).'*');
            }
        }

        if(count($terms) === 0) return $response->withJson([]);

        $sql = <<<SQL
        select id, name, name_en, city, city_en, country, country_en, matching, MATCH (name) 
            AGAINST (:term1 IN BOOLEAN MODE) as rel, IF(INSTR(name, :term3) = 0,9999,INSTR(name, :term4)) as rel2
          from `engine_hotel` 
            WHERE MATCH (name, city, country) 
            AGAINST (:term2 IN BOOLEAN MODE) ORDER BY rel DESC, rel2 LIMIT :limit
SQL;
        $hotels1 = $manager->getConnection()->select($sql, [
            'term1' => implode(' ', $terms),
            'term2' => implode(' ', $terms),
            'term3' => $term2,
            'term4' => $term2,
            'limit' => $limit*4
        ]);

        $query = explode(' ', trim($requestData['term']));
        $query = join(' ', array_map(function ($val){ return $val.'*'; }, $query));

        $hotels2 = $manager->getConnection()->select('SELECT id, name, name_en, city, city_en, country, country_en, matching,  MATCH (name,city,country) AGAINST (:search IN BOOLEAN MODE) as rel
                            FROM `engine_hotel` WHERE MATCH (name,city,country) AGAINST (:search2 IN BOOLEAN MODE)
                            ORDER BY rel DESC LIMIT :limit', [
                                'search' => $query,
                                'search2' => $query,
                                'limit' => $limit*4
                            ]);

        $hotels = array_merge($hotels1, $hotels2);

        $tmp = [];
        $result = [];
        foreach ($hotels as $hotel){
            $matching = json_decode($hotel->matching, true);
            if(!isset($tmp[$hotel->id])){
                $result[] = [
                    'hotel_id' => $hotel->id,
                    'name_ru' => $hotel->name,
                    'name_en' => $hotel->name_en ?? null,
                    'city_ru' => $hotel->city ?? null,
                    'country_ru' => $hotel->country ?? null,
                    'city_en' => $hotel->city_en ?? null,
                    'country_en' => $hotel->country_en ?? null
                ];
            }

            $tmp[$hotel->id] = true;
            if($matching === null) continue;

            foreach ($matching as $item){
                $tmp[$item] = true;
            }
        }

        $count = count($result);

        return $response
            ->withJson([
            'count' => $count > $limit ? $limit : $count,
            'result' => array_slice($result, 0, $limit)
        ]);
    }

    public function locationSearchAction(Request $request, Response $response, DatabaseManager $manager)
    {
        $term = $request->getAttribute('data')['term'];

        $terms = preg_split('/\s+/', $term);
        foreach ($terms as &$term){
            if(Str::length($term) > 2){
                $term = sprintf('(%s|%s)', $term.'*', $this->swithLayout($term).'*');
            }else{
                continue;
            }
        }

        if(count($terms) === 0) return $response->withJson([]);

        $sql = <<<SQL
        select complete_location.*, 
            MATCH (name_ru, name_en, province_en, province_ru, country_ru, country_en)
              AGAINST (:term_select IN BOOLEAN MODE) as score 
            from complete_location 
            WHERE 
              MATCH (name_ru, name_en, province_en, province_ru, country_ru, country_en)
                AGAINST (:term IN BOOLEAN MODE) ORDER BY score DESC LIMIT :limit
SQL;

        $locations = $manager->getConnection()->select($sql, [
                'term_select' => implode(' ', $terms),
                'term' => implode(' ', $terms),
                'limit' => 30
            ]
        );

        return $response->withJson([
            'count' => count($locations),
            'result' => $locations
        ]);
    }
    ... 
}
```

после использования YAGNI, как мне кажется, я о YAGNI узнал только на уроке, т.е.
добавления в качетсве search engine Sphinx, появился интерфейс HotelSearchInterface 
и контролер получил вид:

```php
/**
 * Class CompleteController
 * @see \EngineBundle\Middleware\AutoCompleteMiddleware
 * @package EngineBundle\Controller
 */
class CompleteController
{
    public function hotelSearchAction(Request $request, Response $response, HotelSearchInterface $search)
    {
        $requestData = array_replace(
            ['term' => '', 'limit' => 10],
            $request->getAttribute('data', [])
        );
        $term = $requestData['term'];
        $limit = (int)$requestData['limit'] ?: 10;

        $hotels = $search->search($term, $limit);

        return $response
            ->withJson([
            'count' => count($hotels),
            'result' => $hotels
        ]);
    }
    ...
}
```

На этом хотел бы завершить, можно конечно заглянуть в 2006 год, но там жесть (php 5.2 c отключеным E_STRICT и WARNING),
 global и все такое, но все еще живет и работает, пример https://www.lhl.ru. 
Пару лет назад перебрал код, чтоб запустился на PHP 5.4 c ERROR_ALL и E_NOTICE
