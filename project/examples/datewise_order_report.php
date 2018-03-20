<?php session_start();
	include("dbconnection.php");
	

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Business Hub');
$pdf->SetTitle('Product Report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Order Report','', array(0,64,255), array(0,64,128));
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

	$rs=$con->query("select *from customer c ,city ct ,`sales` s,`sales detail` sd,product p where  c.cust_id=s.cust_id and ct.city_id=c.city and s.sales_orde_id=sd.order_id and p.product_id=sd.product_id and p.business_owner_id='".$_SESSION["id"]."' and sales_date>='".$_POST["t1"]."' and sales_date<='".$_POST["t2"]."' order  by orderstatus desc");

$html = <<<EOD
<br>
<h3><b>Date Wise Order Report</b></h3>
<br>
<table border="1">
<tr>
 	<td style="border:1px solid black;padding:5px">Order id</td>
	<td style="border:1px solid black;padding:5px">Order Status</td>
	<td style="border:1px solid black;padding:5px">Order Date</td>
        <td style="border:1px solid black;padding:5px">Customer Name</td>
	<td style="border:1px solid black;padding:5px">Address</td>
	<td style="border:1px solid black;padding:5px">City</td>
	<td style="border:1px solid black;padding:5px">Phone</td>
	</tr>
EOD;

//$html=$html."<table border='1'>";

while($rd=$rs->fetch())
{

$rsod=$con->query("select *from product p,`product sub category` psc,`business owner` bo,`sales detail` c where bo.business_owner_id=p.business_owner_id  and p.productsubcat_id=psc.productsubcat_id and c.product_id=p.product_id and c.order_id='".$rd["sales_orde_id"]."'");


$html=$html."<tr><td>".$rd["sales_orde_id"]."</td>";
$html=$html."<td>".$rd["orderstatus"]."</td>";
$html=$html."<td>".$rd["sales_date"]."</td>";
$html=$html."<td>".$rd["cust_name"]."</td>";
$html=$html."<td>".$rd["cust_address"]."</td>";
$html=$html."<td>".$rd["city_name"]."</td>";
$html=$html."<td>".$rd["phone"]."</td></tr>";
/*$html=$html."<tr><td colspan='7'><table border='1'>";


$html=$html."<tr><td>Product id</td><td>Name</td><td>Product Sub Category Name</td><td>Price</td><td>Description</td><td>Image</td><td>Quantity</td><td>Business Owner Name</td></tr>";

$html=$html."</table></td></tr>";
*/
}


$html=$html."</table>";



$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '',true);

$pdf->Output('example_001.pdf', 'I');



?>


