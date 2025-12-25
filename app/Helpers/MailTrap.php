<?php
namespace App\Helpers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
 class MailTrap {
    static function send($config) {
    $mail = new PHPMailer(true);
  try {
    $mail->SMTPDebug = 0;                     
    $mail->isSMTP();                                         
    $mail->Host       = config("services.mail.host");                     
    $mail->SMTPAuth   = true;                                 
    $mail->Username   = config("services.mail.username");                     //SMTP username
    $mail->Password   = config("services.mail.password");                              
    $mail->SMTPSecure = config("services.email.encryption");
    $mail->Port       = config("services.mail.port");                                   

    $mail->setFrom(
        isset($config["from_address"]) ? $config["from_address"] : config("services.mail.from_address"),
        isset($config["from_name"]) ? $config["from_name"] : config("services.mail.from_name"),

    );
    $mail->addAddress($config["recipient_address"],isset($config["recipient_name"]) ? $config["recipient_name"] : null);   


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $config["subject"];
    $mail->Body    = $config["body"];

   if (! $mail->send()) return false;
   else return true;
    echo 'Message has been sent';
} catch (Exception $e) {
    return false;
}
}
}