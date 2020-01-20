<?php



$string = file_get_contents("config.json");

$option = json_decode($string);



define("MAIL_HOST", $option->MAIL_HOST);

define("MAIL_TITLE", $option->MAIL_TITLE);



if (isset($_POST['name']))

    $name = $_POST['name'];

else

    $name = "unknown";


if (isset($_POST['author']))

    $author = $_POST['author'];

else

    $author = "unknown";

if (isset($_POST['comment']))

    $comment = $_POST['comment'];

else

    $comment = "unknown";


if (isset($_POST['email']))

    $email = $_POST['email'];

else

    $email = "unknown";


if (isset($_POST['subject']))

    $subject = $_POST['subject'];

else

    $subject = "unknown"; 


if (isset($_POST['phone']))

    $phone = $_POST['phone'];

else

    $phone = "unknown";


if (isset($_POST['message']))

    $message = nl2br($_POST['message']);

else

    $message = "unknown";

if (isset($_POST['username']))

    $username = nl2br($_POST['username']);

else

    $username = "unknown";

if (isset($_POST['password']))

    $password = nl2br($_POST['password']);

else

    $password = "unknown";

if (isset($_POST['register_username']))

    $register_username = nl2br($_POST['register_username']);

else

    $register_username = "unknown";

if (isset($_POST['register_password']))

    $register_password = nl2br($_POST['register_password']);

else

    $register_password = "unknown";



if (MAIL_HOST != null) {

    $to = MAIL_HOST;

} else {

    $to = "trieuau@gmail.com";

}

$from = $email;

if (MAIL_TITLE != null) {

    $subject = MAIL_TITLE;

} else {

    $subject = '[Novas] Contact Form Message';

}

$message = '<b>Name:</b>'.$name. '<br><b>Email:</b>'.$email. '<br><b>Comment:</b>'.$comment. '<br><b>Author:</b>'.$author. '<br><b>Phone:</b>'.$phone. '<br><b>Username:</b>'.$username. '<br><b>Password:</b>'.$password. '<br><b>Register Username:</b>'.$register_username. '<br><b>Register Password:</b>'.$register_password. '<br><b>Subject:</b>'.$subject. '<br> <p>'.$message.'</p>';

$headers = "From: $from\n";

$headers .= "MIME-Version: 1.0\n";

$headers .= "Content-type: text/html; charset=iso-8859-1\n";

if( mail($to, $subject, $message, $headers) ) {

    $serialized_data = '{"type":"success", "message":"Contact form successfully submitted. Thank you, I will get back to you soon!"}';

    echo $serialized_data;

} else {

    $serialized_data = '{"type":"danger", "message":"Contact form failed. Please send again later!"}';

    echo $serialized_data;

}

