<?php

require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Function to send mail.
 *
 * @param string $id
 *   Email id of the receiver.
 *
 * @param string $new_random_password
 *   Generated random password to be sent to the user's email.
 */
function mailer($id, $new_random_password) {
  require __DIR__ . '/creds.php';
  require 'vendor/autoload.php';

  // Object of PHP Mailer.
  $mail = new PHPMailer(true);

  try {
    // Server settings.
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    // Sender's username.
    $mail->Username = $sender_email;
    // SMTP password.
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    // Sender's email.
    $mail->setFrom($sender_email, 'Mailer');
    // Receiver's email.
    $mail->addAddress($id);
    // Content of email.
    $mail->isHTML(true);
    // Subject of the email.
    $mail->Subject = 'Password Reset';
    // Body of the email.
    $mail->Body    = <<<END
    <h2> This is your new passqord for reset your old password. </h2>
    <h3 style="background-color:yellow;"> $new_random_password </h3>
    <p> The OTP will be valid for 2 mins. </p>
    <p> Use this password for log in. </p>
    <p> It is recommended to change this password with new one. </p>
    END;
    // Send mail.
    $mail->send();
  }
  catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
