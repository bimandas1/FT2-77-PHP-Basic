<?php

require __DIR__ . '/vendor/autoload.php';
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
  public function sendMail($receiver_email) {
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
      $this->mail->Body    = MAIL_CONTENT;
      $this->mail->AltBody = MAIL_CONTENT_ALTERNATIVE;
      $this->mail->send();
      echo 'Message has been sent';
    }
    catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
    }
  }
}
