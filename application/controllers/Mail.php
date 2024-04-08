<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/creds.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Class to send mail.
 */
class Mail {
  public $mail;

  /**
   * Constructor function to create PHPMailer object.
   */
  function __construct() {
    $this->mail = new PHPMailer(true);
  }

  /**
   * Function to set mail parameters and send mail.
   *
   * @param string
   *   Receiver's email id.
   */
  public function sendMail($receiver_email, $otp) {
    try {
      // Server settings.
      $this->mail->Host = 'smtp.gmail.com';
      $this->mail->SMTPAuth = true;
      $this->mail->isSMTP();
      $this->mail->Username = SENDER_EMAIL;
      $this->mail->Password = SMTP_PASSWORD;
      $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $this->mail->Port = 465;

      // Sender & receiver's information.
      $this->mail->setFrom(SENDER_EMAIL, 'Sender Name');
      $this->mail->addAddress($receiver_email, 'Receiver Name');

      // Mail Content.
      $this->mail->isHTML(true);
      $this->mail->Subject = MAIL_SUBJECT;
      $this->mail->Body = <<<END
        <h2> This is your new passqord for reset your old password. </h2>
        <h3 style="background-color:yellow;"> $otp </h3>
        <p> The OTP will be valid for 2 mins. </p>
        <p> Use this password for log in. </p>
        <p> It is recommended to change this password with new one. </p>
      END;
      $this->mail->AltBody = MAIL_CONTENT_ALTERNATIVE;
      $this->mail->send();
    }
    catch (Exception $e) {
      echo 'Error while sending mail' . $e->getMessage();
    }
  }
}
