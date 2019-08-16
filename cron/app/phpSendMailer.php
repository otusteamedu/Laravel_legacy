<?php

namespace cron\app;

use PHPMailer\PHPMailer\PHPMailer;

class phpSendMailer
{
    public function sendMail()
    {

        $settings = new \globalSettings();

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $settings->getPostHost();
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $settings->getPostUser();
        $mail->Password = $settings->getPostPassword();
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $settings->getPostPort();
        $mail->setFrom($settings->getPostUser(), 'online-gymnasium');
        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
        $mail->isHTML(true);
        $mail->CharSet = "utf-8";

        return $mail;
    }

    public function sendMailError()
    {
        $sendPrepareMail = $this->sendMail();
        $sendPrepareMail->addAddress('bv@online-gymnasium.ru');
        $sendPrepareMail->Subject = 'В БД остались не обработанные данные';
        $sendPrepareMail->Body = 'В БД остались лиды не добавленные в bitrix24';
        $sendPrepareMail->send();
    }

}