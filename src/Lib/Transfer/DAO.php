<?php
/**
 * DAO переноса данных для зарегистрировавшихся пользователей
 */

namespace Transfer;

class DAO {

    const MEMCACHED_KEY_BY_EMAIL = "user_index_by_email:%s";
    const MEMCACHED_KEY_BY_PHONE = "user_index_by_phone:%s";

    const MEMCACHED_EXPIRE = 1200; // 20 min

    public static function getHavingRequestsUserIdsByEmail($email, $currentUserId) {
        $memKey = sprintf(self::MEMCACHED_KEY_BY_EMAIL, $email);

        $ids = \Db\Memcached\ConnectionManager::getConnection()->get($memKey);

        if (is_array($ids) && empty($ids)) {
            return [];
        }

        if ($ids === false) {
            $rawIds = \User\Finder_DAOIndex::getInstance()->getIdsByEmail($email);

            if (($index = array_search($currentUserId, $rawIds)) !== false) {
                unset($rawIds[$index]);
            }

            $ids = self::checkUsers($rawIds);

            \Db\Memcached\ConnectionManager::getConnection()->set($memKey, $ids, self::MEMCACHED_EXPIRE);
        }

        return $ids;
    }

    public static function getHavingRequestsUserIdsByPhone($phone, $currentUserId) {
        $memKey = sprintf(self::MEMCACHED_KEY_BY_PHONE, $phone);

        $ids = \Db\Memcached\ConnectionManager::getConnection()->get($memKey);

        if (is_array($ids) && empty($ids)) {
            return [];
        }

        if ($ids === false) {
            $rawIds = \User\Finder_DAOIndex::getInstance()->getIdsByPhone($phone);

            if (($index = array_search($currentUserId, $rawIds)) !== false) {
                unset($rawIds[$index]);
            }

            $ids = self::checkUsers($rawIds);

            \Db\Memcached\ConnectionManager::getConnection()->set($memKey, $ids, self::MEMCACHED_EXPIRE);
        }

        return $ids;
    }

    /**
     * @param $rawIds
     * @return array
     */
    private static function checkUsers($rawIds) {
        $ids = [];
        $users = \User\Manager::getUsersByIds($rawIds);

        /**@var $User \User\Model */
        foreach ($users as $User) {
            if ($User->isSetBit(\User\Model::BIT_HAS_REQUESTS) && $User->get('origin') === \User\Model::ORIGIN_MANAGER) {
                array_push($ids, $User->id());
            }
        }

        return $ids;
    }

    public static function deleteMainIndexByUserId($userId) {
        \User\Index::deleteMainIndexByUserId($userId);
        \Db\Memcached\ConnectionManager::getConnection()->delete(sprintf(self::MEMCACHED_KEY_BY_EMAIL, $userId));
    }

    public static function deletePhoneIndexByUserId($userId) {
        \User\Index::deletePhoneIndexByUserId($userId);
        \Db\Memcached\ConnectionManager::getConnection()->delete(sprintf(self::MEMCACHED_KEY_BY_PHONE, $userId));
    }

}
