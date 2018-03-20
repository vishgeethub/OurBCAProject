<?php
	include("adminheader.php");
	include("dbconnection.php");
	$id=$_GET["x"];
	$rd=$obj->query("select *From advertiser_table where advertiserid='$id' ");
	$rdc=$rd->fetch();
?>
<style>
	.error{
		color:red;
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
	.tbox{
		border:2px solid #b3b3b3;
		background:#dddddd;
		width:200px;
		font-size:18px;
		border-radius:15px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
	.tbl{
	border-collapse: separate;
    border-spacing: 2px 2px;
	border-color:dark grey;
	}
	</style>
<center>
<form action="updateadvertiser.php" method="post">
<span class="header">Edit Advertiser</span>
<br>
<br>
<input type="hidden"  style="width:300px;height:38px" value='<?php echo $rdc["advertiserid"]; ?>' name="id">
<table>
<tr>
  	<td style="font-size:18px;"><b>Advertiser Name:</b></td>
   	<td style="padding:5px"><input type="text" class="tbox"  style="width:300px;height:38px"  value='<?php echo $rdc["name"]; ?>' name="t1"></td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Company Name:</b></td>
	<td style="padding:5px"><input type="text" class="tbox" style="width:300px;height:38px" value='<?php echo $rdc["companyname"]; ?>' name="t2"></td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Contact No:</b></td>
	<td style="padding:5px"><input type="text" class="tbox" style="width:300px;height:38px" value='<?php echo $rdc["contactno"]; ?>' name="t3"></td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Email ID:</b></td>
	<td style="padding:5px"><input type="text" class="tbox" style="width:300px;height:38px" value='<?php echo $rdc["emailid"]; ?>' name="t4"></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="Submit" value="Update" class="tbox" name="b1"  style="width:150px">
	<input type="Reset" value="Cancel" name="b2" class="tbox" style="width:150px"></td>
</tr>

</table>
</form>
<br>
<br>
<br>

<td></td>
<td></td>
<?php
	$db=$obj->query("select * from advertiser_table");
?>
<span class="table" > Advertiser Details</span>
<br><br>
<table class="tbl" border="2">
<tr>
	
	<td style="padding:10px;font-size:16px;"><b><u>Advertiser Name</u></b></td>
	<td style="padding:10px;font-size:16px;"><b><u>Company Name</u></b></td>
	<td style="padding:10px;font-size:16px;"><b><u>Contact No.</u></b></td>
	<td style="padding:10px;font-size:16px;"><b><u>Email ID</u></b></td>
	<td style="padding:10px;font-size:16px;"><b><u>Edit</u></b></td>
	<td style="padding:10px;font-size:16px;"><b><u>Delete</u></b></td>
</tr>
	<?php
		while($dbs=$db->fetch())
		{
	?>
		<tr>
			
			<td style="padding:10px;font-size:16px"><?php echo $dbs["name"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $dbs["companyname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $dbs["contactno"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $dbs["emailid"]; ?></td>
			<td style="padding:10px;font-size:16px" width="6%"><a href='editadvertiser.php?x=<?php echo $dbs["advertiserid"]; ?>'><img src="image\edit.png"  height=30 width=30></a></td>
			<td style="padding:10px;font-size:16px" width="6%"><a href='deleteadvertiser.php?x=<?php echo $dbs["advertiserid"]; ?>'><img src="image\delete.png"  height=30 width=30></a></td>
		</tr>
	<?php
		}
	?>
</table>
<?php
	include("adminfooter.php");
?></center>