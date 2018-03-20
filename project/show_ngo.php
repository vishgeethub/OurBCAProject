<?php 
	include("adminheader.php");
?><style>
	.error{
		color:grey;
		font-family:bookman old style;
	}
	.header{
		color:dark grey;
		font-family:bookman old style;
		font-size:50px;
		text-decoration:underline;
	}
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

<span class="table">Registered NGO:</span><br><br>
<br>
<?php
		include("dbconnection.php");
		$rsb=$obj->query("select * from ngo_table n,area a,city c,state s where a.areaid=n.areaid and s.stateid=c.stateid and c.cityid=a.cityid");
		?>
<table class="tbl" border=2>
	<tr>
		<td style="padding:10px;font-size:16px"><u><b>NGO Name</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Address</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Area</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>City</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>State</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Email ID</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Website</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Phone No.</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Logo</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Description</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Registration Date</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Status</u></b></td>
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
			<td style="padding:10px;font-size:16px" width="50%"><?php echo $rsf["emailid"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["website"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["phone"]; ?></td>
			<td style="padding:10px;font-size:16px"><img src='<?php echo $rsf["logo"]; ?>' width='50px' height='50px'></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["description"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php $org=$rsf["rdate"]; echo date("d-m-Y", strtotime($org)) ?></td>
			<td style="padding:10px;font-size:16px"><?php if( $rsf["status"]=0) {echo "Inactive";} else {echo "Active";} ?></td>
			</tr>
             <?php
			}
			 ?>
			</table>
<?php
	include("adminfooter.php");
?></center>