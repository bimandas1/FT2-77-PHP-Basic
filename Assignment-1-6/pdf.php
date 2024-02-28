<?php

require(__DIR__ . '/fpdf186/fpdf.php');

session_start();

$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$phone = $_SESSION['phone'];
$email = $_SESSION['email'];

// Session unset & destroy
session_unset();
session_destroy();

// Create pdf
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'First Name : ');
$pdf->Cell(40, 10, $firstName . ' ' . $lastName);
$pdf->Ln();
$pdf->Cell(40, 10, 'Phone no. : ');
$pdf->Cell(40, 10, $phone);
$pdf->Ln();
$pdf->Cell(40, 10, 'Email: ');
$pdf->Cell(40, 10, $email);

$pdf->Output();
$pdf->Output('F', __DIR__ . '/pdfs/user.pdf');  // Save pdf in server
?>
