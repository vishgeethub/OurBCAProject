<?php 
	include("dbconnection.php");
	

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('All India NGO');
$pdf->SetTitle('All India NGO`s');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'All India NGO`s','', array(0,64,255), array(0,64,128));
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

$pdf->SetFont('dejavusans', '', 8, '', true);

$pdf->AddPage();

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$rs=$con->query("select * from user_table u, area a, city c,state s where a.areaid=u.areaid and a.cityid=c.cityid and s.stateid=c.stateid and a.cityid='".$_POST["cid"]."'");
$html="Date:".date("d-m-Y");
$html = $html.<<<EOD
<br>
<h3><b>Citywise User Report</b></h3>
<br>
<table border="1">
<tr>
 	<td style="border:1px solid black;padding:5px">User Name</td>
	<td style="border:1px solid black;padding:5px">State</td>
	<td style="border:1px solid black;padding:5px">City</td>
	<td style="border:1px solid black;padding:5px">Phone No.</td>
    	<td style="border:1px solid black;padding:5px" width="7%">Gender</td>
	<td style="border:1px solid black;padding:5px">Date of Birth</td>
	<td style="border:1px solid black;padding:5px;width:150px;">Email ID</td>
	<td style="border:1px solid black;padding:5px" width="6%">Status</td>

	</tr>
EOD;

//$html=$html."<table border='1'>";

while($rd=$rs->fetch())
{
if($rd["status"]=0)
{
	$act="Inactive";
}
else
{
	$act="Active";
}
if($rd["gender"]='M')
{
	$gen="Male";
}
else{
	$gen="Female";
}

$org=$rd["dob"];  
$html=$html."<tr><td>".$rd["uname"]."</td>";
$html=$html."<td>".$rd["statename"]."</td>";
$html=$html."<td>".$rd["cityname"]."</td>";
$html=$html."<td>".$rd["phone"]."</td>";
$html=$html."<td>".$gen."</td>";
$html=$html."<td>".date("d-m-Y", strtotime($org))."</td>";
$html=$html."<td>".$rd["emailid"]."</td>";
$html=$html."<td>".$act."</td></tr>";

}
$html=$html."</table>";



$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '',true);

$pdf->Output('example_001.pdf', 'I');



?>

