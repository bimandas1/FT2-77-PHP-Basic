<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Fpdf\Fpdf;

/**
 * Generate PDF.
 */
class GeneratePdf {
  /**
   * Generate PDF for bill invoice.
   *
   * @param array $rows
   *   Cart details.
   */
  public function generate(array $rows) {
    $pdf = new Fpdf();
    $pdf->AddPage();
    $pdf->Rect(5, 5, 200, 287);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(90, 10, 'Product name:', 1, 0, 'L', false, '');
    $pdf->Cell(50, 10, 'Price (Rs)', 1, 0, 'L', false, '');
    $pdf->Cell(50, 10, 'quantity', 1, 1, 'L', false, '');

    $total = 0;
    $count = 0;

    foreach ($rows as $row) {
      $pdf->Cell(90, 10, $row['name'], 1, 0, 'L', false, '');
      $pdf->Cell(50, 10, $row['price'], 1, 0, 'L', false, '');
      $pdf->Cell(50, 10, $row['quantity'], 1, 1, 'L', false, '');
      $total += $row['price'] * $row['quantity'];
      $count += $row['quantity'];
    }

    $pdf->Cell(90, 10, 'Total:', 1, 0, 'L', false, '');
    $pdf->Cell(50, 10, $total, 1, 0, 'L', false, '');
    $pdf->Cell(50, 10, $count, 1, 0, 'L', false, '');
    try {
      // Save the pdf.
      $pdf->Output('F', __DIR__ . '/../public/assests/pdfs/Invoice.pdf');
      return TRUE;
    }
    catch (Exception $e) {
      return FALSE;
    }
  }
}
