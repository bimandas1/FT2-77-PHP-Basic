<?php

require_once __DIR__ . '/../models/QueryModel.php';
require_once __DIR__ . '/../../helpers/Mail.php';

/**
 * cnotroller to manage buy products.
 */
class BuyController {
  private $db;
  private $mail;

  /**
   * Constructor function to create object of QueryModel and Mail.
   */
  function __construct() {
    $this->db = new QueryModel();
    $this->mail = new Mail();
  }

  /**
   * Function to invoke basic operations.
   */
  public function invoke() {
    session_start();
    if(isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
      $cartDetails = $this->db->getCartDetails($email);

      // Generate bill invoice pdf.
      require_once __DIR__ . '/../../helpers/GeneratePdf.php';
      $pdf = new GeneratePdf();
      if($pdf->generate($cartDetails) == TRUE) {
        // Send cart items and bill invoice pdf to mail.
        $this->mail->setReceiver($email);
        $this->mail->setMailForBillInvoice();
        if($this->mail->sendMail() == TRUE) {
          // Respond ok.
          echo '1';
        }
        else {
          echo '0';
        }
      }
      else {
        echo '0';
      }
    }
    else {
      header('location: /login');
    }
  }
}
