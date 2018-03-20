<?php
	include("adminheader.php");
	include("dbconnection.php");
	$id=$_GET["x"];
	$db=$obj->query("select * from advertiser_table");
	$rd=$obj->query("select *From advertisement_table where advertisementid='$id'");
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
		font-size:50px;;
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
	input[type="text"]
	{
		font-size:18px;
	}
	input[type="file"]
	{
		font-size:18px;
	}
	input[type="date"]
	{
		font-size:18px;
	}
	</style>
<center>
<form action="updateadvertisement.php" method="post" enctype="multipart/form-data"> 
<span class="header">Edit Advertisement</span>
<br>
<br>
<input type="hidden" value='<?php echo $rdc["advertisementid"]; ?>' name="id">
<table>
<tr>
	<td style="font-size:18px;"><b>Image:</b></td>
	<td style="padding:5px"><input type="file" class="tbox" name="i1"  style="width:300px;height:38px" ><img src='<?php echo $rdc["photo"]; ?>' width="50" height="50"></td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Navigate URL:</b></td>
	<td style="padding:5px"><textarea rows="5" cols="25" class="tbox" name="t1"  style="width:300px;height:38px;font-size:18px;"><?php echo $rdc["navigateURL"]; ?></textarea>
</tr>
<tr>
	<td style="font-size:18px;"><b>Posted Date:</b></td>
	<td style="padding:5px"><input type="date" name="t2" class="tbox"  style="width:300px;height:38px" value='<?php echo $rdc["posteddate"]; ?>'></td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Ending Date:</b></td>
	<td style="padding:5px"><input type="date" name="t3" class="tbox" style="width:300px;height:38px"  value='<?php echo $rdc["enddate"]; ?>'></td>
</tr>
<tr>
	<td><b>Select Advertiser:</b></td>
	<td style="padding:5px"><select name="t4" class="tbox" style="width:300px;height:38px;font-size:18px;">
		<option value=0>---Select Advertiser---</option>
		<?php
			while($dbs=$db->fetch())
			{
				if($rdc["advertiserid"]==$dbs["advertiserid"])
				{
		?>
			<option selected value='<?php echo $dbs["advertiserid"]; ?>'><?php echo $dbs["companyname"]; ?></option>
		<?php
				}
				else
				{
		?>
			<option value='<?php echo $dbs["advertiserid"]; ?>'><?php echo $dbs["companyname"]; ?></option>
		<?php
				}
			}
		?>
	    </select>
	</td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Amount:</b></td>
	<td style="padding:5px"><input type="text" class="tbox" name="t5"  style="width:300px;height:38px" value='<?php echo $rdc["amount"]; ?>'></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="Submit" class="tbox" name="b1"   style="width:150px;font-size:18px;">	
	<input type="reset" value="Cancel" name="b2" class="tbox" style="width:150px;font-size:18px;"></td>
</tr>
</table>
</form>
<?php
	$rs=$obj->query("select *From advertisement_table a,advertiser_table t where a.advertiserid=t.advertiserid");
?>
<br>
<br>
<br>
<br>
<br><br>
<br><br>
<br><br>
<span class="table" > Advertisement Details</span>
<br><br>
<table class="tbl" border=2>
<tr>
	<td style="padding:10px;font-size:16px"><b><u>Photo</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Navigation URL</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Posted Date</td>
	<td style="padding:10px;font-size:16px"><b><u>Ending Date</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Advertisement Comapany</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Amount</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Delete</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Edit</b></u></td>
	
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
	<tr>
				<td style="padding:10px"><img src='<?php echo $db["photo"]; ?>' height=100 width=100></td>
				<td style="padding:10px;font-size:16px"><a href='<?php echo $db["navigateURL"]; ?>'>Navigation URL</a></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["posteddate"]; ?></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["enddate"]; ?></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["companyname"]; ?></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["amount"]; ?></td>
				<td style="padding:10px;font-size:16px" width="6%"><a href='deleteadvertisement.php?x=<?php echo $db["advertisementid"]; ?>'><img src="image\delete.png"  height=30 width=30></a></td>
				<td style="padding:10px;font-size:16px" width="6%"><a href='editadvertisement.php?x=<?php echo $db["advertiserid"]; ?>'><img src="image\edit.png"  height=30 width=30></a></td>
			
			</tr>
	<?php
	   }
	?>
</table>
</center>
<?php
	include("adminfooter.php");
?>