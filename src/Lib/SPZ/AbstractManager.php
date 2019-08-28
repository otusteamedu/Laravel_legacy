<?php

namespace SPZ;

use Helper\HumanistException;

abstract class AbstractManager {

    const AGE_LAST_3_HOURS = 1;
    const AGE_TODAY = 2;
    const AGE_WEEK = 3;
    const AGE_MONTH = 4;
    const AGE_YEAR = 5;
    const AGE_ALL = 6;

    const INDEX_TYPE_SPART = \SPZ\RequestModel::REQUEST_TYPE_SPART;
    const INDEX_TYPE_CONSULT = \SPZ\RequestModel::REQUEST_TYPE_CONSULT;
    const INDEX_TYPE_CARSERVICE = \SPZ\RequestModel::REQUEST_TYPE_CARSERVICE;

    const SEARCH_TYPE_TEXT = 'text';
    const SEARCH_TYPE_CONSULT = 'consult';
    const SEARCH_TYPE_NEW = 'new';
    const SEARCH_TYPE_MINE = 'mine';
    const SEARCH_TYPE_COMPANY = 'company';


    protected static $closeReasons = [
        RequestModel::STATUS_FINISHED => \Conversation\Model::CLOSE_REASON_CANCEL,
        RequestModel::STATUS_CANCELLED => \Conversation\Model::CLOSE_REASON_CANCEL,
        RequestModel::STATUS_EXPIRED => \Conversation\Model::CLOSE_REASON_EXPIRE,
        RequestModel::STATUS_DELETED => \Conversation\Model::CLOSE_REASON_MODERATE,
    ];



    protected static function validateContactType(array &$data, \User\Model $Owner) {
        if ($Owner->isVirtual() && count($Owner->get('phones')) > 0) {
            $data['contactType'] = RequestModel::CONTACT_PHONE;
        } else if ($Owner->isVirtual() && $Owner->hasEmail()) {
            $data['contactType'] = RequestModel::CONTACT_EMAIL;
        }

        if (!isset($data['contactType'])) {
            $data['contactType'] = RequestModel::CONTACT_SERVICE;
        }

        switch ($data['contactType']) {

            //МНОГО КОДА

            default:
                return false;
        }

        return true;
    }

    public static function makeRequestObject($data, $requestType, $scenario = null) {

        if ($requestType) {
            $data['requestType'] = $requestType;
        } else {
            $requestType = $data['requestType'];
        }

        switch ($requestType) {
            case RequestModel::REQUEST_TYPE_SPART:
                return new SPartRequestModel($data, null, $scenario);

            case RequestModel::REQUEST_TYPE_CONSULT:
                return new ConsultRequestModel($data);

            case RequestModel::REQUEST_TYPE_CARSERVICE:
                return new CarserviceRequestModel($data, null, $scenario);

            default:
                throw new \RuntimeException('unknown request type: ' . $requestType);
        }
    }

    /**
     * @param RequestModel $RequestModel
     * @param array $data
     * @return mixed
     */
    protected static function setMasterUnits($RequestModel, $data) {}

    protected static function createRequest(\User\Model $Owner, $data, $requestType, $origin = RequestModel::ORIGIN_USER) {
        $userId = $Owner->id();

        /** @var RequestModel $RequestModel */
        $RequestModel = static::makeRequestObject(null, $requestType);

        if (!static::validateContactType($data, $Owner)) {
            throw new RequestException('Неверно указан способ связи');
        }

        $data = [
                'userId' => $userId,
                'origin' => $origin,
            ] + $data;

        if (isset($data['cityId'])) {
            $data['countryId'] = \Geo\Manager::getCityById($data['cityId'])['countryId'];
        }

        $RequestModel->setData($data);

        static::setMasterUnits($RequestModel, $data);

        if (!$RequestModel->save()) {
            throw new RequestValidationException('Invalid input', $RequestModel->errors);
        }

        static::queueIndexTask(self::INDEX_EVENT_NEW, $userId, $RequestModel->id);

        return $RequestModel;
    }

    /**
     * @param RequestModel $RequestModel
     * @return bool
     */
    private static function isCompanyNoticeNeeded(RequestModel $RequestModel){
        return $RequestModel->isCompany();
    }

    /**
     * Когда нужна нотификация по персональному запросу
     * @param RequestModel $RequestModel
     * @return bool
     */
    private static function isPersonalNoticeNeeded(RequestModel $RequestModel){
        /**
         * Для виртуального запроса по телефону не нужна: менеджер сразу принимает этот запрос и попадает в подбор
         */
        return $RequestModel->isPersonal() && $RequestModel->origin == $RequestModel::ORIGIN_USER;
    }



    public static function getRequestDataById($ownerId, $id) {
        $result = ShardDAO::getInstance($ownerId)->getRequestById($id);
        if ($result) {
            $result = static::makeRequestObject($result)->data;
        }
        return $result;
    }

    /**
     * @param int|\User\Model $Owner
     * @param $id
     * @param bool $withVehicle
     * @throws RequestValidationException
     * @throws RequestException
     * @return RequestModel SPartRequestModel CarserviceRequestModel ConsultRequestModel
     */
    public static function getRequestById($Owner, $id, $withVehicle = true) {
        if (!($Owner instanceof \User\Model)) {
            if (is_numeric($Owner) && ((int) $Owner) > 0) {
                $Owner = \User\Manager::getUserById($Owner, false);
            } else {
                \Project\Logger::logText(\Project\Logger::LOGFILE_USER, 'Owner is a strange guy: ' . json_encode($Owner));
                return null;
            }
        }

        $requestData = ShardDAO::getInstance($Owner->id())->getRequestById($id);

        if (!$requestData) {
            \Project\Logger::logText(\Project\Logger::LOGFILE_APOCALYPSE, 'Не удалось найти запрос. userId:' . $Owner->id() . ', requestId: ' . $id);
            return null;
        }

        $Request = static::makeRequestObject($requestData);
        return $Request;
    }

    /**
     * @param RequestModel $Model
     * @param $data
     * @throws RequestValidationException
     */
    public static function updateRequest(RequestModel $Model, $data) {
        $Model->setData($data, true);
        if (!$Model->save(false)) {
            throw new \RuntimeException('cannot update request ' . $Model->userId . ':' . $Model->id);
        }
    }


    /**
     * @param $ownerId
     * @param $unitId
     * @param int $requestType
     * @param $data
     * @throws RequestValidationException
     * @throws RequestException
     */
    public static function updateUnit($ownerId, $unitId, $requestType, $data) {
        $Request = static::makeRequestObject(['userId' => $ownerId, 'requestType' => $requestType]);
        $Unit = $Request->getUnit($unitId);
        if (!$Unit) {
            \Project\Logger::logText(\Project\Logger::LOGFILE_WARNING,
                sprintf(static::LOG_TEXT_EMPTY_UNIT, $ownerId, $unitId)
            );
            throw new RequestException('Произошла ошибка');
        }

        $Unit->setData($data, true);
        if (!$Unit->validate()) {
            throw new RequestValidationException('Invalid input', $Unit->errors);
        }

        $Unit->save(false);
    }

    /**
     * @param $ownerId
     * @param $shadowId
     * @param $originRequestId
     * @param int $requestType
     * @param $data
     * @return \SPZ\UnitModel
     * @throws RequestValidationException
     */
    public static function addUnit($ownerId, $shadowId, $originRequestId, $requestType, $data) {
        $Request = static::makeRequestObject(['userId' => $ownerId, 'requestType' => $requestType]);
        $Unit  = $Request->getNewUnit($data);
        $Unit->userId = $ownerId;
        $Unit->requestId = $shadowId;
        $Unit->originId = $originRequestId;

        if (!$Unit->validate()) {
            throw new RequestValidationException('Invalid input', $Unit->errors);
        }

        $Unit->save();
        return $Unit;
    }

    /**
     * @param $ownerId
     * @param $unitId
     * @param int $requestType
     * ownerId
     */
    public static function deleteUnit($ownerId, $unitId, $requestType) {
        static::updateUnit($ownerId, $unitId, $requestType, ['status' => UnitModel::TYPE_DELETED]);
    }


    /**
     * @param int $ownerId
     * @param int $shadowCopyId
     * @param int $requestType
     * @return UnitModel[]
     */
    public static function getItemsFromUnit($ownerId, $shadowCopyId, $requestType) {
        $Request = static::makeRequestObject(['userId' => $ownerId, 'requestType' => $requestType]);
        return $Request->getUnits($shadowCopyId);
    }

    public static function getUnit($ownerId, $unitId, $requestType) {
        $Request = static::makeRequestObject(['userId' => $ownerId, 'requestType' => $requestType]);
        return $Request->getUnit($unitId);
    }


    /**
     * @param \User\Model $Owner
     * @param $requestId
     * @param \User\Model|int $User
     * @param $solutionId
     * @param $closeStatus
     * @param $closeReason
     * @throws RequestException
     * @throws \Helper\HumanistException
     */
    public static function closeRequest(\User\Model $Owner, $requestId, $User, $solutionId = null, $closeStatus = RequestModel::STATUS_CANCELLED, $closeReason = null) {
        // МНОГО КОДА
    }


    /**
     * @param \User\Model|int $Owner
     * @param $requestId
     * @param \User\Model $ForManager
     * @param bool $autoAccept automatically accept by client (virtual request or consultation)
     * @return \Conversation\Model беседа
     * @throws RequestException
     */
    public static function reserveRequest($Owner, $requestId, \User\Model $ForManager, $autoAccept = false) {
        // МНОГО КОДА
    }

    /**
     * @param $ownerId
     * @param $requestId
     * @throws RequestNotFoundException
     */
    public static function freeReservedRequest($ownerId, $requestId) {
        // МНОГО КОДА
    }

    /**
     * @return int
     */
    public static function freeReservedRequests() {
        $requests = static::getRedisDao()->getOutdatedRequests(time());
        foreach ($requests as $request) {
            static::freeReservedRequest($request[0], $request[1]);
        }
        return count($requests);
    }

    /**
     * @return \Locker\Locker
     */
    private static function getLocker() {
        if (!static::$Locker) {
            $config = \Project\Config::get(static::LOCKER_CONFIG)[static::LOCKER_SERVER];
            static::$Locker = new \Locker\Locker($config['host'], $config['port']);
        }

        return static::$Locker;
    }

    /**
     * @param $requestId
     * @param \User\Model $Owner
     * @return \Vehicle\Model
     */
    public static function getVehicleByRequestId($requestId, \User\Model $Owner) {
        $Request = static::getRequestById($Owner, $requestId);
        if (!$Request) {
            return false;
        } else {
            return new \Vehicle\Model($Request->vehicleSnapshot);
        }
    }

    public static function flushUserNManagerRequestList($userId = 0, $managerId = 0) {
        $Memcached = ShardDAO::getShardMemcachedConnection();

        if ($userId) {
            $Memcached->delete($userId, ShardDAO::MEMCACHED_OPENED_REQUESTS_BY_USER_ID);
        }

        if ($managerId) {
            $Memcached->delete($managerId, ShardDAO::MEMCACHED_OPENED_REQUESTS_BY_USER_ID);
        }
    }

    /**
     * @attention! Используется для вызова из \Conversation\Manager
     * @param $ownerId
     * @param $data
     * @param $UnitId
     * @param $shadowCopyId
     * @param int $requestType
     * @throws RequestException
     * @throws \Exception
     * @throws \Helper\HumanException
     * @throws \Project\ValidatorException
     * @return ItemModel
     */
    public static function createItem($ownerId, $data, $UnitId, $shadowCopyId, $requestType) {

        if (!$Unit = static::getUnit($ownerId, $UnitId, $requestType)) {
            \Project\Logger::logText(\Project\Logger::LOGFILE_WARNING, "Unit with id: $UnitId not exists");
            throw new RequestException('Произошла ошибка');
        }

        if ((int)$Unit->requestId !== $shadowCopyId) {
            \Project\Logger::logText(\Project\Logger::LOGFILE_WARNING, "Ids mismatch, request id in shadow part: {$Unit->requestId}, incoming shadow id: $shadowCopyId");
            throw new RequestException('Произошла ошибка');
        }

        $Item = $Unit->createItem($data);

        if (!$Item->validate()) {
            throw new \Project\ValidatorException('Ошибка ввода', $Item->errors);
        }

        try {
            if ($Item->save(false)) {
                return $Item;
            } else {
                throw new \RuntimeException('$Item->save() returned false 0_o. Check it asap!!11');
            }
        } catch(\Exception $E) {
            \Project\Logger::logException(\Project\Logger::LOGFILE_APOCALYPSE, $E);
            throw new RequestException('Произошла ошибка');
        }
    }

    public static function updateItem($ownerId, $requestType, $itemId, $data) {
        $Request = static::makeRequestObject(['userId' => $ownerId, 'requestType' => $requestType]);
        $Item = $Request->getItem($itemId);
        if (!$Item) {
            return false;
        }

        if ($ownerId !== $Item->userId) {
            \Project\Logger::logText(\Project\Logger::LOGFILE_WARNING, "Trying to update foreign item, userId: $ownerId, positionId: {$Item->id}");
            throw new RequestException('Произошла ошибка');
        }

        $Item->setData($data);
        if (!$Item->validate()) {
            throw new \Project\ValidatorException('Ошибка ввода', $Item->errors);
        }

        try {
            $result = $Item->save(false);
        } catch(\Exception $E) {
            \Project\Logger::logException(\Project\Logger::LOGFILE_APOCALYPSE, $E);
            throw new RequestException('Произошла ошибка');
        }

        return $result;
    }

    public static function deleteItem($ownerId, $requestType, $itemId) {
        $Request = static::makeRequestObject(['userId' => $ownerId, 'requestType' => $requestType]);
        $Item = $Request->getItem($itemId);
        if (!$Item) {
            return false;
        }

        if ($ownerId !== $Item->userId) {
            \Project\Logger::logText(\Project\Logger::LOGFILE_WARNING, "Trying to delete foreign item, userId: $ownerId, positionId: {$Item->id}");
            throw new RequestException('Произошла ошибка');
        }

        try {
            $Item->delete() ;
        } catch(\Exception $E) {
            \Project\Logger::logException(\Project\Logger::LOGFILE_APOCALYPSE, $E);
            throw new RequestException('Произошла ошибка');
        }

        return true;
    }

    /**
     * @return RedisDAO
     */
    public static function getRedisDao() {
        return RedisDAO::getInstance();
    }

    /**
     * @return SearchDAO
     */
    protected static function getSearchDao() {
        return SearchDAO::getInstance();
    }


    public static function queueIndexTask($event, $userId, $requestId, $extra = []) {
        static::getRedisDao()->queueIndexTask([
                'event' => $event,
                'userId' => $userId,
                'requestId' => $requestId,
            ] + $extra);
    }

    /**
     * @param int $managerId
     * @param int $companyId
     * @param array $params
     * @param int $offset
     * @param int $limit
     * @param array $orderBy
     * @return array[] [{id, userId, openManagers, closedManagers, status, type, companies}]
     * @throws \Helper\NotFoundException
     */
    protected static function searchRequestEntries($managerId, $companyId, $params, $offset, $limit, $orderBy = []) {
        $isClosed = false;

        $statuses = [];
        $seeReserved = false;
        $seePersonal = false;

        // МНОГО КОДА

        if ($statuses) {
            $criteria['status'] = $statuses;
        } else {
            $criteria['!status'] = RequestModel::STATUS_DELETED;
        }

        return static::getSearchDao()->search($criteria, $isClosed, $limit, $offset, $orderBy);
    }

    public static function search($managerId, $companyId, $params, $offset = 0, $limit = null, $orderBy = [], $includeData = true) {
        if (!isset($params['search'])) {
            throw new \Helper\NotFoundException;
        }

        if (!isset($limit)) {
            $limit = static::REQUESTS_LIMIT;
        }

        $entries = static::searchRequestEntries($managerId, $companyId, $params, $offset, $limit, $orderBy);

        if (!$includeData) {
            return $entries;
        }

        $result = [];

        // МНОГО КОДА

        return $result;
    }


    public static function getPersonalNCompanyRequests($managerId, $companyId, $count) {
        $RedisDao = static::getRedisDao();
        $result = array_values($RedisDao->listPersonalRequests($managerId));
        if (count($result) >= $count) {
            return array_slice($result, 0, $count);
        }

        $companyRequests = $RedisDao->listCompanyRequests([RequestModel::REQUEST_TYPE_SPART, RequestModel::REQUEST_TYPE_CARSERVICE], $companyId, $managerId, $count - count($result));
        return array_merge($result, array_values($companyRequests));
    }

    public static function getCompanyConsults($managerId, $companyId) {
        return static::getRedisDao()->listCompanyRequests(RequestModel::REQUEST_TYPE_CONSULT, $companyId, $managerId);
    }

    public static function countPersonalNCompanyRequests($managerId, $companyId) {
        $RedisDao = static::getRedisDao();
        $requestType = [RequestModel::REQUEST_TYPE_SPART, RequestModel::REQUEST_TYPE_CARSERVICE];
        return $RedisDao->countPersonalRequests($managerId) + $RedisDao->countCompanyRequests($requestType, $companyId, $managerId);
    }

    public static function countCompanyConsults($managerId, $companyId) {
        return static::getRedisDao()->countCompanyRequests(RequestModel::REQUEST_TYPE_CONSULT, $companyId, $managerId);
    }


    public static function declinePersonalRequest($managerId, $clientId, $requestId) {
        $Client = \User\Manager::getUserById($clientId, false);
        static::closeRequest($Client, $requestId, $managerId);
    }

    public static function declineCompanyRequest($companyId, $requestId, $requestType) {
        static::getRedisDao()->forgetCompanyRequest($companyId, $requestId, $requestType);
    }


    public static function getLastMessageTime($userId, $requestId) {
        $result = 0;
        $conversationIds = \Conversation\Manager::getConversationIds($userId, $requestId, \Conversation\Model::$openStatuses);
        foreach ($conversationIds as $id) {
            $result = max($result, \Conversation\Manager::getLastMessageTime($id));
        }
        return $result;
    }

    public static function touchRequestIndex($userId, $requestId, $timestamp = null) {
        if (!isset($timestamp)) {
            $timestamp = time();
        }
        static::queueIndexTask(static::INDEX_EVENT_TOUCH, $userId, $requestId, ['updatedTime' => $timestamp]);
    }

    public static function expire($userId, $requestId) {
        $Client = \User\Manager::getUserById($userId, false);
        $ServiceUser = \User\Manager::getServiceUser();
        static::closeRequest($Client, $requestId, $ServiceUser, null, RequestModel::STATUS_EXPIRED);
        SearchDAO::getInstance()->delete($requestId, false);
    }

    public static function logNewRequest(RequestModel $Request) {
        $requestId = $Request->id;
        $userId = $Request->userId;
        $requestType = $Request->requestType;
        $Vehicle = $Request->getVehicle();
        $data = [
            'name' => $Request->getUser()->getName(),
        ];

        if ($requestType == RequestModel::REQUEST_TYPE_SPART || $requestType == RequestModel::REQUEST_TYPE_CARSERVICE) {
            $data['car'] = $Vehicle->brandName . ' ' . $Vehicle->modelName . ' ' . $Vehicle->releaseYear;
        }

        \Project\EventLogger::getInstance()->log($requestType, $userId, $requestId, 0, $data);
    }

    protected static function logClosedRequest(RequestModel $Request) {
        $status = $Request->status;
        if (!isset (static::$closeEvents[$status])) {
            return;
        }

        $shardId = $Request->userId;
        $objectId = $Request->id;
        $event = static::$closeEvents[$status];
        $otherId = ($event == \Project\EventLogger::EVENT_REQUEST_SOLVED ? $Request->solutionId : 0);
        \Project\EventLogger::getInstance()->log($event, $shardId, $objectId, $otherId);
    }
}