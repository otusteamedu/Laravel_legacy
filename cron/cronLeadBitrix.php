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
            (new app\PhpSendMailer())->sendMailError();
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
        $db = new app\BdSQLlite();
        for ($i = 0; $i <= count($result->result) - 1; $i++) {

            if (isset($result->result[$i]->PHONE[0]->VALUE)) {
                $devManager = new app\PhoneCheck();
                $devManager->takeType($result->result[$i]->PHONE[0]->VALUE);
               // $db->queryBDrequest($result->result[$i]->PHONE[0]->VALUE, 'phone');
            }
//            if (isset($result->result[$i]->EMAIL[0]->VALUE)) {
//
//                $devManager = new emailChecker();
//                $devManager->queryBDrequest($result->result[$i]->EMAIL[0]->VALUE);
//            //    $db->queryBDrequest($result->result[$i]->EMAIL[0]->VALUE, 'email');
//            }
        }

        return $db->queryBDrequest(null, 'selectAll');
    }


}

(new cronLeadBitrix())->checkLeadSQLlite();

