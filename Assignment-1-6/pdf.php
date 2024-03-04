<?php

require(__DIR__ . '/fpdf186/fpdf.php');
// Create pdf.
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Name : ' . $full_name);
$pdf->Ln();
$pdf->Cell(40, 10, 'Phone no. : ' . $phone);
$pdf->Ln();
$pdf->Cell(40, 10, 'Email: ' . $email);
$pdf->Ln();
$pdf->Ln();

// Subject - Mark table.
$pdf->SetFillColor(180, 180, 180);

$pdf->Cell(40, 10, 'Subject', 1, 0, 'C', TRUE);
$pdf->Cell(40, 10, 'Mark', 1, 0, 'C', TRUE);
$pdf->Ln();

foreach ($sub_mark_arr as $sub => $mark) {
  $pdf->Cell(40, 10, $sub, 1, 0, 'C', TRUE);
  $pdf->Cell(40, 10, $mark, 1, 0, 'C', TRUE);
  $pdf->Ln();
}

// Save pdf at server side.
$pdf->Output('F', __DIR__ . '/pdfs/user.pdf');
// Download the pdf.
$pdf->Output('D', $full_name . 'pdf');
