<?php
	include("adminheader.php");
	include("dbconnection.php");
	$db=$obj->query("select * from state")
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
	<script>
	function check()
	{
		var city=document.f1.t1.value;
		var sid=document.f1.t2.value;
		flag=true;
		if(city=="")
		{
			flag=false;
			document.getElementById("d1").innerHTML="Enter city";
		}
		else
		{
			document.getElementById("d1").innerHTML="";
		}
		if(sid=="0")
		{
			flag=false;
			document.getElementById("d2").innerHTML="Select state";
		}
		else
		{
			document.getElementById("d2").innerHTML="";
		}
		return flag;
	}
		
</script>
<center>
<form action="addcity.php" name="f1" onsubmit="return check();" method="post">
<center>
<span class="header">Add City</span>

<br>
<br>
<table>
<tr>
		<td style="font-size:18px;"><b>City Name:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height:38px">
		<span id="d1" class="error"></span></td>
</tr>
<tr>
		<td style="font-size:18px;"><b>State</b><span style="color:red">*</span></td>
		<td style="padding:5px">
		<select name="c1" class="tbox" style="width:300px;height:38px">
			<option value="0">---Select State---</option>
			<?php
				while($rs=$db->fetch())
				{
			?>
				<option value='<?php echo $rs["stateid"]; ?>'><?php echo $rs["statename"]; ?></option>
			<?php
				}
			?>
			
		</select>
		<span id="d2" class="error"></span>
 </td>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
		<td>&nbsp;</td>
		<td style="padding:5px"><input type="Submit" class="tbox" value="Submit" name="b1" style="width:150px;font-size:18px;">
		<input type="Reset" value="Cancel" name="b2" class="tbox" style="width:150px;font-size:18px;"></td>
</tr>

</table>
</center>
</form>

 <br>
<?php
 	if(isset($_GET["y"]))
	{
?>	
		<font color="red"><b>This city already exist.</b></font>
<?php
	}
?>
<br>

<?php
	include("dbconnection.php");
	$rs=$obj->query("select * From city c,state s where c.stateid=s.stateid");
?>
<center>
<span class="table">City Details</span>
<br>
<br>
<table class="tbl" border=2>

<tr>
	
	<td style="padding:10px;font-size:16px;"><b><u>City_Name</b></u></td>
	<td style="padding:10px;font-size:16px;"><b><u>State_Name</b></u></td>
	<td style="padding:10px;font-size:16px;"><b><u>Delete</b></u></td>
	<td style="padding:10px;font-size:16px;"><b><u>Edit</b></u></td>
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
				
				<td style="padding:10px;font-size:16px;"><?php echo $db["cityname"]; ?></td>
				<td style="padding:10px;font-size:16px;"><?php echo $db["statename"]; ?></td>
				<td style="padding:10px;font-size:16px;" width="6%"><a href='deletecity.php?x=<?php echo $db["cityid"]; ?>' onclick="return confirm('You sure you want to delete <?php echo $db["cityname"]; ?> ?'); "><img src="image\delete.png" height=30 width=30></a></td>
				<td style="padding:10px;font-size:16px;" width="6%"><a href='editcity.php?x=<?php echo $db["cityid"]; ?>' onclick="return confirm('You sure you want to edit <?php echo $db["cityname"]; ?> ?'); "><img src="image\edit.png" height=30 width=30></a></td>
			</tr>
	<?php
	   }
	?>
</table>
</center>
<?php
	include("adminfooter.php");
?></center>