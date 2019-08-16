<?php

namespace cron;

require_once '../vendor/autoload.php';

use globalSettings;
use cron\app;


class cronLeadBitrix
{
    /**
     * @throws \Exception
     */
    public function checkLeadSQLlite()
    {
        $presenceNotProcessedLead = $this->check();
        if ($presenceNotProcessedLead) {
            (new app\phpSendMailer())->sendMailError();
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getLeadFromCRM()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => (new globalSettings())->getUrlLeadList(),
            CURLOPT_POSTFIELDS => http_build_query(array('select' => array('PHONE', 'EMAIL'))),));
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result);

        if (array_key_exists('error', $result)) throw new \Exception("Ошибка при получении списка лидов: " . $result['error_description']);

        return $result;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function check()
    {
        $result = $this->getLeadFromCRM();
        for ($i = 0; $i <= count($result->result) - 1; $i++) {

            if (isset($result->result[$i]->PHONE[0]->VALUE)) {
                $this->queryBDrequest($result->result[$i]->PHONE[0]->VALUE, 'phone');
            }
            if (isset($result->result[$i]->EMAIL[0]->VALUE)) {
                $this->queryBDrequest($result->result[$i]->EMAIL[0]->VALUE, 'email');
            }
        }

        return $this->queryBDrequest(null, 'selectAll');
    }

    public function queryBDrequest($params, $type)
    {

        $db = new app\bdSQLlite();

        if ($type == 'selectAll') {
            $sql = "SELECT * FROM addLead";
            $resalt = $db->openBD()->query($sql);
            $resaltBDLead = $resalt->fetchArray(SQLITE3_ASSOC);
            $db->openBD()->close();
        } else {
            $sql = "SELECT id FROM addLead WHERE $type = '$params' AND msage = 'Ok'";
            $resalt = $db->openBD()->query($sql);
            $resaltBDLead = $resalt->fetchArray(SQLITE3_ASSOC);
            $sql = "DELETE FROM addLead WHERE id = '$resaltBDLead[id]'";
            $db->openBD()->query($sql);
            $db->openBD()->close();
        }
        return $resaltBDLead;
    }
}

(new cronLeadBitrix())->checkLeadSQLlite();

