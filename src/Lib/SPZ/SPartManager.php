<?php


namespace SPZ;


class SPartManager extends AbstractManager {

    public static function create($Owner, $data) {
        return parent::createRequest($Owner, $data, RequestModel::REQUEST_TYPE_SPART);
    }

    protected static function setMasterUnits($RequestModel, $data) {
        if (!empty($data['parts'])) {
            $RequestModel->setMasterUnits($data['parts']);
        }
    }
}
