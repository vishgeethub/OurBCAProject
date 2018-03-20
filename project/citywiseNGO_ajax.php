<?php
	$cid=$_GET["x"];
	include("dbconnection.php");
	$rsb=$obj->query("select * from ngo_table n, area a, city c,state s where a.areaid=n.areaid and a.cityid=c.cityid and s.stateid=c.stateid and a.cityid='$cid'");
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
	.tbox{
		border:2px solid #b3b3b3;
		background:#dddddd;
		width:200px;
		border-radius:15px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
	</style>
<center>
   <br>
<span class="table">Details of NGO</span><br><br>
<br>

<table class="tbl" border=2>
	<tr>
		<td style="padding:10px;font-size:16px"><u><b>NGO Name</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Address</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Area</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>City</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>State</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Email ID</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Phone No.</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Registration Date</u></b></td>
	</tr>
	<?php	
			while($rsf=$rsb->fetch())
			{
		?>
			<tr>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["NGOname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["address"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["areaname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["cityname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["statename"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["emailid"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["phone"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php $org=$rsf["rdate"]; echo date("d-m-Y", strtotime($org)) ?></td>
			</tr>
             <?php
			}
			 ?>
			</table>
<br>
		<form action="tcpdf/examples/citywiseNGO.php" method="post">
    <input type="hidden" value='<?php echo $cid ?>' name="cid">
    <input type="submit" class="tbox" value="Export To PDF">
   </form>	
</center>