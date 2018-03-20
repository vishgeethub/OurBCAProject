<?php
	$date1=$_GET["x"];
	$date2=$_GET["y"];
	
	include("dbconnection.php");
	$rsb=$obj->query("select * from event_table e,category_table ca,area a, city c,state s  where ca.cat_id = e.cat_id and a.areaid=e.areaid and a.cityid=c.cityid and s.stateid=c.stateid and e.eventdate>='$date1' and e.eventdate<='$date2' order by e.eventdate");
?>
<style>
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
.table{
		color:dark grey;
		font-family:bookman old style;
		font-size:35px;
		text-decoration:underline;	
		}
	</style>
	

   <br>
<center>

<span class="table"> Event Details</span><br><br>
<br>

<table class="tbl" border=2>
	<tr>
		<td style="padding:10px"><b><u>Event Name</b></u></td>
		<td style="padding:10px" width="9%"><b><u>Event Date</b></u></td>
		<td style="padding:10px"><b><u>Event Time</b></u></td>
		<td style="padding:10px"><b><u>Venue</b></u></td>
		<td style="padding:10px"><b><u>State</b></u></td>
		<td style="padding:10px"><b><u>City</b></u></td>
		<td style="padding:10px"><b><u>Area</b></u></td>
		<td style="padding:10px"><b><u>Contact No.</b></u></td>
		<td style="padding:10px"><b><u>Category</b></u></td>
	</tr>
	<?php	
			while($rsf=$rsb->fetch())
			{
		?>
			<tr>
			<td style="padding:10px"><?php echo $rsf["eventname"]; ?></td>
			<td style="padding:10px"><?php $org=$rsf["eventdate"]; echo date("d-m-Y", strtotime($org))?></td>
			<td style="padding:10px"><?php echo $rsf["eventtime"]; ?></td>
			<td style="padding:10px"><?php echo $rsf["venue"]; ?></td>
			<td style="padding:10px"><?php echo $rsf["statename"]; ?></td>
			<td style="padding:10px"><?php echo $rsf["cityname"]; ?></td>
			<td style="padding:10px"><?php echo $rsf["areaname"]; ?></td>
			<td style="padding:10px"><?php echo $rsf["contactno"]; ?></td>
			<td style="padding:10px"><?php echo $rsf["cat_name"]; ?></td>
			</tr>
             <?php
			}
			 ?>
			</table>
			<br>
			<form action="tcpdf/examples/datewiseEvent.php" method="post">
    <input type="hidden" value='<?php echo $date1 ?>' name="date1">
	  <input type="hidden" value='<?php echo $date2 ?>' name="date2">
    <input type="submit" class="tbox" value="Export To PDF">	
   </form>
		
