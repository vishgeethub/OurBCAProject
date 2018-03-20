<?php 
	include("ngoheader.php");
?>
<style>
	.error{
		color:grey;
		font-family:bookman old style;
	}
	.header{
		color:dark grey;
		font-family:bookman old style;
		font-size:50px;
		font-weight:bolder;
		text-decoration:underline;
	}
	.table{
		color:dark grey;
		font-family:bookman old style;
		font-size:25px;
		font-weight:bolder;
		text-decoration:underline;
	}
	</style>

<span class="table">Events Details</span>
<br>
<br>
<?php
		include("dbconnection.php");
		$rsb=$obj->query("select * from event_table n,area a,city c,state s,category_table ct where a.areaid=n.areaid and c.cityid=a.cityid and c.stateid=s.stateid and ct.cat_id=n.cat_id order by n.eventdate ");
		?>
<table border=4>
	<tr>
		<td style="padding:10px;font-size:16px"><b><u>Event Name</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Description</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Event Date</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Event Time</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Venue</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>State</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>City</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Area</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Event Picture</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Contact No.</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Category</b></u></td>
	</tr>
	<?php	
			while($rsf=$rsb->fetch())
			{
		?>
			<tr>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["eventname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["description"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php $org=$rsf["eventdate"]; echo date("d-m-Y", strtotime($org)) ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["eventtime"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["venue"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["statename"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["cityname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["areaname"]; ?></td>
			<td style="padding:10px;font-size:16px"><img src='<?php echo $rsf["eventphoto"]; ?>' width='50px' height='50px'></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["contactno"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["cat_name"]; ?></td>
			</tr>
             <?php
			}
			 ?>
			</table>
<?php
	include("ngofooter.php");
?></center>