<?php

require_once __DIR__ . '/../core/Dotenv.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Class to send mail.
 */
class Mail {
  public $mail;

  /**
   * Constructor function to create objects.
   */
  function __construct() {
    $this->mail = new PHPMailer(true);
    $dotEnv = new Dotenv();
    $this->mailConfig();
  }

  /**
   * Function to configure the mail parameters.
   */
  private function mailConfig() {
    // Server settings.
    $this->mail->Host = $_ENV['MAIL_HOST'];
    $this->mail->SMTPAuth = true;
    $this->mail->isSMTP();
    $this->mail->Username = $_ENV['SENDER_EMAIL'];
    $this->mail->Password = $_ENV['SMTP_PASSWORD'];
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $this->mail->Port = 465;

    // Sender information.
    $this->mail->setFrom($_ENV['SENDER_EMAIL'], 'Sender Name');
  }

  /**
   * Set receiver's email.
   *
   * @param string $receiver_email
   *   recever's email.
   */
  public function setReceiver(string $receiver_email) {
    // Set Receiver's email.
    $this->mail->addAddress($receiver_email, 'Receiver Name');
  }

  /**
   * Set mail content for sending OTP.
   *
   * @param string $otp
   *   OTP to be send.
   */
  public function setMailForOTP(string $otp) {
    $this->mail->isHTML(true);
    $this->mail->Subject = 'OTP to verify your email';
    $this->mail->Body = <<<END
      <h2> The OTP is to authenticate the email. </h2>
      <h3 style="background-color:yellow;"> $otp </h3>
      <p> The OTP will be valid for 2 mins. </p>
    END;
  }

  /**
   * Set mail content for sending bill invoice.
   */
  public function setMailForBillInvoice() {
    $this->mail->isHTML(true);
    $this->mail->Subject = 'Bill Invoice';
    $this->mail->Body = <<<END
      <h2> Your bill invoice. </h2>
    END;

    // Add invoice pdf as attachment.
    $this->mail->addAttachment(__DIR__ . '/../public/assests/pdfs/Invoice.pdf','PDF','base64','application/pdf');
  }

  /**
   * Function to set mail parameters and send mail.
   */
  public function sendMail() {
    try {
      $this->mail->send();
      // Respond ok.
      return TRUE;
    }
    catch (Exception) {
      return FALSE;
    }
  }
}
