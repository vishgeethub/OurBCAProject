<?php
if(isset($_POST["b1"]))
{
$type=$_POST["r1"];
include("connection.php");

		if($type=="1")
		{
			$rd=$con->query("select * from student_master s,passenger p where s.passenger_id=p.passengerid");
		}
		else
		{
			$rd=$con->query("select * from services_pass s,passenger p where s.passenger_id=p.passengerid");
		}
		
	
?>

<table border="1">

	<tr>
		<td><b>Name</b></td>
		<td><b>Address</b></td>
		<td><b>Phone</b></td>
		<td><b>DOB</b></td>
		<td><b>Appply_date</b></td>
		<td><b>Pass Status</b></td>
	</tr>
	
	<?php
	
		while($rs=$rd->fetch())
		{
		
		?>
			<tr>
			<td><?php echo strtoupper($rs["fname"])." ".strtoupper($rs["lname"]); ?></td>
			<td><?php echo strtoupper($rs["address"]);?></td>
			<td><?php  echo strtoupper($rs["phone"]); ?></td>
			<td><?php  echo strtoupper($rs["dob"]); ?></td>
			<td><?php  echo strtoupper($rs["apply_date"]); ?></td>
			<td><?php  echo strtoupper($rs["pass_status"]); ?></td>
			</tr>
		<?php
		}
	?>

</table>



<?php
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="passtypewise.xls"');

  }
   else
     {
        require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('AMTS');
$pdf->SetTitle('Typewise User');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'TypeWise Report','', array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

$pdf->setFontSubsetting(true);

$pdf->SetFont('dejavusans', '', 14, '', true);

$pdf->AddPage();

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$type=$_POST["r1"];
include("connection.php");

		if($type=="1")
		{
			$rs=$con->query("select * from student_master s,passenger p where s.passenger_id=p.passengerid");
		}
		else
		{
			$rs=$con->query("select * from services_pass s,passenger p where s.passenger_id=p.passengerid");
		}
		

$html = <<<EOD
<table border="1">
	<tr>
		<td><b>Name</b></td>
		<td><b>Address</b></td>
		<td><b>Phone</b></td>
		<td><b>DOB</b></td>
		<td><b>Appply_date</b></td>
		<td><b>Pass Status</b></td>
	</tr>
EOD;


while($rd=$rs->fetch())
{
$html=$html."<tr><td>".strtoupper($rd["fname"])." ".strtoupper($rd["lname"])."</td>";
$html=$html."<td>".$rd["address"]."</td>";
$html=$html."<td>".$rd["phone"]."</td>";
$html=$html."<td>".$rd["dob"]."</td>";
$html=$html."<td>".$rd["apply_date"]."</td>";
$html=$html."<td>".$rd["pass_status"]."</td></tr>";

}


$html=$html."</table>";



$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '',true);

$pdf->Output('typewise.pdf', 'I');



       }
?>