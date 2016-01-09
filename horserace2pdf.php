
<?php

require("../pdfgen/fpdf.php"); // path to fpdf.php

/*
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output(); 
 */

class TablePDF extends FPDF
{
function buildTable($header, $data)
{
$this->setFillColor(255, 0, 0);
$this->setTextColor(255);
$this->setDrawColor(128, 0, 0);
$this->setLineWidth(0.3);
$this->setFont('', 'B');
//Header
// make an array for the column widths
$widths = array(85, 40, 15);
// send the headers to the PDF document
for($i = 0; $i < count($header); $i++) {
$this->cell($widths[$i], 7, $header[$i], 1, 0, 'C', 1);
}
$this->ln();
// Color and font restoration
$this->setFillColor(175);
$this->setTextColor(0);
$this->setFont('');
// now spool out the data from the $data array
$fill = 0; // used to alternate row color backgrounds
$url = "http://www.oreilly.com";
foreach($data as $row)
{
$this->cell($widths[0], 6, $row[0], 'LR', 0, 'L', $fill);
// set colors to show a URL style link
$this->setTextColor(0, 0, 255);
$this->setFont('', 'U');
$this->cell($widths[1], 6, $row[1], 'LR', 0, 'L', $fill, $url);
// resore normal color settings
$this->setTextColor(0);
$this->setFont('');
$this->cell($widths[2], 6, $row[2], 'LR', 0, 'C', $fill);
$this->ln();
$fill = ($fill) ? 0 : 1;

}
$this->cell(array_sum($widths), 0, '', 'T');
}
}
//connect to server and select database
$dbc = mysqli_connect('localhost', 'root', '','horseracing') or die("could not connect to database".mysqli_error($dbc));
	
//mysqli_select_db($dbc, $connection) or die( "Could not open {$db} database");
//$sql = "select * from winninghorse order by Race_Time";

if (isset($_POST["myquery"])) {
     
	$sql1 = $_POST['myquery'];
} else{
	$sql1 = "select * from winninghorse order by Race_Time";					
}


$result = mysqli_query($dbc,$sql1) or die( "Could not execute sql: {$sql}");
// build the data array from the database records.
while ($row = mysqli_fetch_array($result)) {
$data[] = array($row['Race_Date'], $row['Horse_No'], $row['Race_Time']);
}
// start and build the PDF document
$pdf = new TablePDF();
// Column titles
$header = array("Race Date & Time", "Horse No", "Time");
$pdf->setFont("Arial", '', 14);
$pdf->addPage();
$pdf->buildTable($header, $data);
$pdf->output();

?>




