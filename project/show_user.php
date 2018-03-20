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
.tbl{
	border-collapse: separate;
    border-spacing: 2px 2px;
	border-color:dark grey;
	}
	</style>

<center>

<span class="table">Registered User</span><br><br>
<br>
<?php
		include("dbconnection.php");
		$rsb=$obj->query("select * from user_table u,area a,city c,state s where a.areaid=u.areaid and c.cityid=a.cityid and s.stateid=c.stateid");
		?>
<table class="tbl" border=2>
	<tr>
		<td style="padding:10px;font-size:16px"><u><b>User Name</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Address</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>State</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>City</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Area</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Phone No.</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Gender</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Date of Birth</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Email ID</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Login ID</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Profile Picture</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Registration Date</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Status</u></b></td>
	</tr>
	<?php	
			while($rsf=$rsb->fetch())
			{
		?>
			<tr>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["uname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["address"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["statename"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["cityname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["areaname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["phone"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php if( $rsf["gender"]='M') {echo "Male";} else {echo "Female";} ?></td>
			<td style="padding:10px;font-size:16px" width="11%"><?php $org=$rsf["dob"]; echo date("d-m-Y", strtotime($org)) ?></td>	
			<td style="padding:10px;font-size:16px"><?php echo $rsf["emailid"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["loginid"]; ?></td>
			<td style="padding:10px;font-size:16px"><img src='<?php echo $rsf["profilepic"]; ?>' width='50px' height='50px'></td>
			<td style="padding:10px;font-size:16px" width="9%"><?php $org=$rsf["rdate"]; echo date("d-m-Y", strtotime($org)) ?></td>
			<td style="padding:10px;font-size:16px"><?php if( $rsf["status"]=0) {echo "Inactive";} else {echo "Active";}?></td>
			</tr>
             <?php
			}
			 ?>
			</table>
<?php
	include("adminfooter.php");
?></center>