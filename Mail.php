<?php

use Models\User;

class Mail
{

    function sendEmail($email, $subject, $message)
    {

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";

        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = 2;
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'ssl://smtp.mail.ru';
            $mail->SMTPAuth = true;
            $mail->Username = 'antareit2018@mail.ru';
            $mail->Password = '123456789!q';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 465;

            //Recipients
            $mail->setFrom('antareit2018@mail.ru', 'Кубок Антарейт');
            $mail->addAddress($email);
            //$mail->addAddress('ellen@example.com');
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    }

    function sendEmailToUser($email, $subject, $variables, $template)
    {
        $query = "
            SELECT uid FROM users
            WHERE user_email = '" . $email . "'
        ";
        $result = self::query($query);
        $data = self::fetch($result);

        if(!empty($data[0]['uid'])) {

            $variables['{MD5UID}'] = md5($data[0]['uid']);
            $variables['{UID}'] = $data[0]['uid'];

            $message = file_get_contents($template);
            $message = str_replace(array_keys($variables), array_values($variables), $message);
            self::sendEmail($email, $subject, $message);
        }
    }

    function sendValidationEmail($email)
    {
        $variables = array(
            '{USER_EMAIL}'      => $email,
            '{USER_PASSWORD}'   => '*****',
            '{VALIDATION_LINK}' => 'http://' . $_SERVER['HTTP_HOST'] . "/supergame/login.php?validate={MD5UID}" . md5($email),
        );
        $template = 'templates/letters/letter.html';
        self::sendEmailToUser(
            $email,
            'Подтвердите Email регистрации в Кубке Антарейт',
            $variables,
            $template
        );
    }

    function sendRegistrationCompleteEmail($email, $password)
    {
        $variables = array(
            '{USER_EMAIL}'      => $email,
            '{USER_PASSWORD}'   => $password,
            '{VALIDATION_LINK}' => 'http://' . $_SERVER['HTTP_HOST'] . "/supergame/login.php?validate={MD5UID}" . md5($email),
        );
        $template = 'templates/letters/letter.html';
        self::sendEmailToUser(
            $email,
            'Регистрация в Кубке Антарейт',
            $variables,
            $template
        );
    }

    function sendNapominanieEmail($email)
    {
        $variables = array(
            '{NAPOMINANIE_LINK}' => 'http://' . $_SERVER['HTTP_HOST'] . "/supergame/login.php?restorepassword={MD5UID}" . md5($email),
        );
        $template = 'templates/letters/napominanie.html';
        self::sendEmailToUser(
            $email,
            'Напоминание пароля в Кубке Антарейт',
            $variables,
            $template
        );
    }

    function sendNewPasswordEmail($email, $password)
    {
        $variables = array(
            '{NEW_PASSWORD}'    => $password,
            '{LOGIN_LINK}'      => 'http://' . $_SERVER['HTTP_HOST'] . "/supergame/#formaAvtorizacii",
        );
        $template = 'templates/letters/newpasswd.html';
        self::sendEmailToUser(
            $email,
            'Новый пароль в Кубке Антарейт',
            $variables,
            $template
        );
    }



}