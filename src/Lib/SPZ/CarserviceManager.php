<?php


namespace SPZ;


class CarserviceManager extends AbstractManager {

    public static function create($Owner, $data)     {
        return parent::createRequest($Owner, $data, RequestModel::REQUEST_TYPE_CARSERVICE);
    }

    protected static function setMasterUnits($RequestModel, $data) {
        if (!empty($data['carservices'])) {
            $RequestModel->setMasterUnits($data['carservices']);
        }
    }

}
