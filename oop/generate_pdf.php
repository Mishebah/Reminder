<?php
//include connection file 
include_once("connection.php");
include_once('pdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
   // $this->Image('logo.png',10,-1,70);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(50);
    // Title
    $this->Cell(80,5,'List of Tasks',1,0,'C');
    // Line break
    $this->Ln(7);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$db = new dbObj();
$connString =  $db->getConnstring();


$display_heading = array('id'=>'ID', 'task'=> 'Task Name', 'dates'=> 'Date(to be) Done','message'=> 'Task Description','status'=>'Status', 'email'=> 'Email', 'emailstatus'=> 'emailstatus',);

$result = mysqli_query($connString, "SELECT task, dates, message FROM assignment") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM assignment WHERE field != 'status'  AND field != 'id' AND  field != 'email' AND  field != 'emailstatus'");

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);


foreach($header as $heading) {
$pdf->Cell(60,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(60,12,$column,1);
}
$pdf->Output();
?>