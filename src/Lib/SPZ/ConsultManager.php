<?php


namespace SPZ;


class ConsultManager extends AbstractManager {

    /**
     * @param \User\Model|int $User
     * @param \Company\Model|int $Company
     * @param array $initData
     * @return ConsultRequestModel
     */
    public static function create($User, $Company, $initData = []) {

        //особый код, отличающийся от parent::createRequest

        $Consult = new ConsultRequestModel($data);
        if (!$Consult->save()) {
            throw new RequestValidationException('Invalid input', $Consult->errors);
        }

        //много кода

        static::queueIndexTask(self::INDEX_EVENT_NEW, $User->id(), $Consult->id);
        static::logNewRequest($Consult);
        return $Consult;
    }


    public static function addConsultMessage($userId, $requestId, $message) {
        $Consult = static::getRequestById($userId, $requestId);
        if (!$Consult or $Consult->requestType <> RequestModel::REQUEST_TYPE_CONSULT or !$Consult->isOpen()) {
            throw new RequestException('запрос ' . $requestId . ' не является консультацией');
        }

        $id = \Db\Sequence\Central_Manager::getNextValue(\Db\Sequence\Central_Manager::TYPE_CONSULT_MESSAGE);
        ShardDAO::getInstance($userId)->addConsultMessage($id, $requestId, $message);
    }

    public static function getConsultMessages($userId, $requestId) {
        return ShardDAO::getInstance($userId)->getConsultMessages($requestId);
    }

    public static function deleteConsultMessages($userId, $requestId) {
        return ShardDAO::getInstance($userId)->deleteConsultMessages($requestId);
    }

    public static function updateConsultUserLastActivity(\User\Model $User, $consultId) {
        if (!$User->isLegit()) {
            return false;
        }

        $Consult = \SPZ\Manager::getRequestById($User, $consultId, $withVehicle = false);
        if (!$Consult || $Consult->requestType <> RequestModel::REQUEST_TYPE_CONSULT || ((int)$Consult->userId) !==  ((int)$User->id())) {
            return false;
        }

        return RedisDAO::getInstance()->updateConsultUserLastActivity($User->id(), $consultId);
    }

}
