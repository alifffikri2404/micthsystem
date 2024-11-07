<?php
include('../../db_conn.php');
date_default_timezone_set('UTC');

$tarikhBln = date('d-m-Y');

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('wedud kacak');
$pdf->SetTitle('MICTH');
$pdf->SetSubject('MICTH');
$pdf->SetKeywords('MICTH, Melaka, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' ', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage('L', 'A4');

$pdf->Write(0, 'RECORD OUTSTATION', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

$html = <<<EOF
<br/>

  <div id="chartContainer" style="height: 300px; width: 50%;">
  </div>


EOF;

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">
    <tr>
       <td>Information printed on : $tarikhBln</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

include('../../db_conn.php');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['emp_no'])) {
    $emp_no = $_POST['emp_no'];
    
    if(isset($_POST['start_date_hidden']) && isset($_POST['end_date_hidden'])) {
        $start_date = $_POST['start_date_hidden'];
        $end_date = $_POST['end_date_hidden'];
        
        $sql = "SELECT * FROM outstation WHERE emp_no = $emp_no AND dateOut BETWEEN '$start_date' AND '$end_date'";
    } else {
        
    }
    $sql = "SELECT * FROM outstation WHERE emp_no=$emp_no";
    $result = $conn->query($sql);
    
} else {
    echo "Please provide the employee number.";
}


$i = 1;

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $debitOutput .= '<tr>';
    $debitOutput .= '<td align="center">' . $i . '</td>';
    $debitOutput .= '<td align="center">' . $row["name"] . '</td>';
    $debitOutput .= '<td>' . $row["emp_no"] . '</td>';
    
   
    $debitOutput .= '<td>' . $row["purpose"] . '</td>';
    $debitOutput .= '<td>' . $row["location"] . '</td>';
    $debitOutput .= '<td>' . $row["dateOut"] . ' / ' . $row["timeOut"] . '</td>';
    $debitOutput .= '<td>' . $row["dateIn"] . ' / ' . $row["timeIn"] . '</td>';
    
    $debitOutput .= '</tr>';
    $i++;
  }
} else {
  $debitOutput .= '<tr><td colspan="8" align="center">Tiada Rekod</td></tr>';
}

$tbl = '<table cellspacing="1" cellpadding="2" border="1" width="100%">';
$tbl .= '<tr style="background-color:#CEE3F6;color:#000000;">';
$tbl .= '<td align="center" width="5%"><strong>No.</strong></td>';
$tbl .= '<td align="center" width="15%"><strong> NAME</strong></td>';
$tbl .= '<td align="center" width="10%"><strong>EMPLOYEE NO.</strong></td>';
$tbl .= '<td align="center" width="15%"><strong>PURPOSE</strong></td>';
$tbl .= '<td align="center" width="15%"><strong>LOCATION</strong></td>';
$tbl .= '<td align="center" width="10%"><strong>CHECK-OUT</strong></td>';
$tbl .= '<td align="center" width="8%"><strong>CHECK-IN</strong></td>';
$tbl .= '</tr>';
$tbl .= $debitOutput;
$tbl .= '</table>';
$tbl .= '<br>
<br>
<br>
<br><table>
			<tr>
				<td>Provided by :</td>
				<td></td>
				<td>Reviewed by:</td>
				<td></td>
				<td>Verified by:</td>
			</tr>
			<br/><br/>
			<tr>
				<td>......................................</td>
				<td></td>
				<td>......................................</td>
				<td></td>
				<td>......................................</td>
			</tr>
			<tr>
				<td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
				<td></td>
				<td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
				<td></td>
				<td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
			</tr>
		</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

ob_end_clean();
$pdf->Output('example_048.pdf', 'I');
