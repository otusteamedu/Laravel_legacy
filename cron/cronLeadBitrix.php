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

        $resaltBDLead = $this->check();

        if ($resaltBDLead) {

            $this->pullEmailErorr();

        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getLeadFromCRM()
    {
        $settings = new globalSettings();
        $queryUrl = 'https://' . $settings->getDomainBitrix() . $settings->getWebhookBitrix() . $settings->getWebhookFunctionBitrix();

        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_POST => 1, CURLOPT_HEADER => 0, CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $queryUrl,
            CURLOPT_POSTFIELDS => http_build_query(array('select' => array( 'PHONE', 'EMAIL' ))),));
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, 1);

        if (array_key_exists('error', $result)) throw new \Exception("Ошибка при получении списка лидов: ". $result['error_description']);

        return $result;
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function pullEmailErorr()
    {
        $sendPrepareMail = new app\phpSendMailer();

        $sendPrepareMail = $sendPrepareMail->sendMail();
        $sendPrepareMail->addAddress('bv@online-gymnasium.ru');
        $sendPrepareMail->Subject = 'В БД остались не обработанные данные';
        $sendPrepareMail->Body = 'В БД остались лиды не добавленные в bitrix24';
        $sendPrepareMail->send();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function check()
    {
        $result = $this->getLeadFromCRM();

        $db = new app\bdSQLlite();

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
        return $resaltBDLead;
    }
}

$cron = new cronLeadBitrix();
$cron->checkLeadSQLlite();

