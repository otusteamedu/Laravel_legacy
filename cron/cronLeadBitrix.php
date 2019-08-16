<?php

namespace cron;

require_once '../vendor/autoload.php';

use globalSettings;
use cron\app;


$settings = new globalSettings();


// CRM server conection data
define('CRM_HOST', $settings->getDomainBitrix());
define('CRM_PARAMS', $settings->getWebhookBitrix());
define('CRM_FUNCTION', $settings->getWebhookFunctionBitrix()); // функция получения списка лидов


class cronLeadBitrix
{
    public function getLeadList()
    {

        $queryUrl = 'https://' . CRM_HOST . CRM_PARAMS . CRM_FUNCTION;

        $queryData = http_build_query(array(
            'select' => array(
                'PHONE',
                'EMAIL'

            )));

        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_POST => 1, CURLOPT_HEADER => 0, CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $queryUrl, CURLOPT_POSTFIELDS => $queryData,));
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, 1);

        if (array_key_exists('error', $result)) echo "Ошибка при получении списка лидов: " . $result['error_description'] . " ";

        $db = new app\bdSQLlite();
        $db->openBD()->busyTimeout(5000);
        $db->openBD()->exec('PRAGMA journal_mode = wal;');

        for ($i = 0; $i <= count($result['result']) - 1; $i++) {

            if ($result['result'][$i]['PHONE'][0]['VALUE']) {

                $params = $result['result'][$i]['PHONE'][0]['VALUE'];
                $sql = "SELECT id FROM addLead WHERE phone = '$params' AND msage = 'Ok'";
                $resalt = $db->openBD()->query($sql);
                $resaltInsert = $resalt->fetchArray(SQLITE3_ASSOC);

                $sql = "DELETE FROM addLead WHERE id = '$resaltInsert[id]'";
                $db->openBD()->query($sql);
                $db->openBD()->close();
            }
            if ($result['result'][$i]['EMAIL'][0]['VALUE']) {

                $params = $result['result'][$i]['EMAIL'][0]['VALUE'];
                $sql = "SELECT id FROM addLead WHERE email = '$params' AND msage = 'Ok'";
                $resalt = $db->openBD()->query($sql);
                $resaltInsert = $resalt->fetchArray(SQLITE3_ASSOC);

                $sql = "DELETE FROM addLead WHERE id = '$resaltInsert[id]'";
                $db->openBD()->query($sql);
                $db->openBD()->close();
            }

        }
        $sql = "SELECT * FROM addLead";
        $resalt = $db->openBD()->query($sql);
        $resaltBDLead = $resalt->fetchArray(SQLITE3_ASSOC);


        $db->openBD()->close();

        if ($resaltBDLead) {

            $sendPrepareMail = new app\phpSendMailer();

            $sendPrepareMail = $sendPrepareMail->sendMail();
            $sendPrepareMail->addAddress('bv@online-gymnasium.ru');
            $sendPrepareMail->Subject = 'В БД остались не обработанные данные';
            $sendPrepareMail->Body = 'В БД остались лиды не добавленные в bitrix24';
            $sendPrepareMail->send();

        }
    }
}

$q = new cronLeadBitrix();
$q->getLeadList();

