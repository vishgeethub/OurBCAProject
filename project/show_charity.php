<?php session_start();
	include("ngoheader.php");
	$nid=$_SESSION["nid"];
?>
<style>
	.table{
		color:dark grey;
		font-family:bookman old style;
		font-size:35px;
		text-decoration:underline;
	}
	.tbl{
	border-collapse: separate;
    border-spacing: 2px 2px;
	border-color:dark grey;
	}
	</style>
	<center>


<span class="table">Charity Details</span>
<br>
<br>
<?php
		include("dbconnection.php");
		$rsb=$obj->query("select * from charity_table c,ngo_table n,user_table u where n.NGOid=c.NGOid and u.uid=c.uid and c.NGOid='$nid' order by c.charitydate ");
		?>
<table class="tbl" border=2>
	<tr>
		<td style="padding:10px;font-size:16px"><u><b>Charity ID</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Donor Name</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>AdharCard No.</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Phone No.</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Email ID</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>NGO Name</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Purpose</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Date</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Amount</u></b></td>
	</tr>
	<?php	
			while($rsf=$rsb->fetch())
			{
		?>
			<tr>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["charityid"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["uname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["adhar_no"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["phone"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["emailid"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["NGOname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["purpose"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php $org=$rsf["charitydate"]; echo date("d-m-Y", strtotime($org))?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["amount"]; ?></td>
			</tr>
             <?php
			}
			 ?>
			</table>
			<br>
			<br>
			<br>
			<br>
			<br>
<?php
	include("adminfooter.php");
?></center>