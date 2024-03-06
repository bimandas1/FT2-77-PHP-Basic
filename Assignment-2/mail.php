<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/creds.php';

$receiver_email = $_POST['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Create an instance, passing `true` enables exceptions.
$mail = new PHPMailer(true);

try {
  // Server settings.
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->isSMTP();
  $mail->Username = $sender_email;
  $mail->Password = $smtp_password;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port = 465;

  // Sender & receiver's information.
  $mail->setFrom($sender_email, 'Sender Name');
  $mail->addAddress($receiver_email, 'Receiver Name');

  // Mail Content.
  $mail->isHTML(true);
  $mail->Subject = $mail_subject;
  $mail->Body    = $mail_content;
  $mail->AltBody = $mail_content_alternative;
  $mail->send();
  echo 'Message has been sent';
}
catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
