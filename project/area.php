<?php
	include("adminheader.php");
	include("dbconnection.php");
	$db=$obj->query("select * from city");
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
	function checknumber(s,dname)
	{
		var l=s.length;
		var i,flag=true;
		for(i=0;i<l;i++)
		{
			var ch=s.charAt(i);
			if((ch>='0' && ch<='9'))
			{
			}
			else
			{
                flag=false;
			}    
		}
		if(flag==false)
        {
			document.getElementById(dname).innerHTML="Only digit's you can enter!!";
        }
        else
        {
            document.getElementById(dname).innerHTML="";
    
        }     
	}
	function check()
	{
		var area=document.f1.t1.value;
		var pincode=document.f1.t2.value;
		var cid=document.f1.t3.value;
		flag=true;
		if(area=="")
		{
			flag=false;
			document.getElementById("d1").innerHTML="Enter area";
		}
		else
		{
			document.getElementById("d1").innerHTML="";
		}
		if(pincode=="")
		{
			flag=false;
			document.getElementById("d2").innerHTML="Enter pincode for area";
		}
		else
		{
			document.getElementById("d2").innerHTML="";
		}
		if(cid=="0")
		{
			flag=false;
			document.getElementById("d3").innerHTML="Select city";
		}
		else
		{
			document.getElementById("d3").innerHTML="";
		}
		return flag;
	}
		
</script>
<center>
<form action="addarea.php" onsubmit="return check();" name="f1" method="post">
<span class="header">Add Area</span><br>
<table>

<tr>
		<td style="font-size:18px"><b>Area Name:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height:38px"><span id="d1" class="error"></span></td>
</tr>
<tr>
		<td style="font-size:18px"><b>Pincode:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t2" onKeyUp="checknumber(this.value,'d2');" style="width:300px;height:38px"><span id="d2" class="error"></span></td>
</tr>
<tr>
<td style="font-size:18px"><b>City:</b><span style="color:red">*</span></td>
<td style="padding:5px">
		<select name="t3" class="tbox" style="width:300px;height:38px">
			<option value="0">---Select City---</option>
			<?php
				while($rs=$db->fetch())
				{
			?>
				<option value='<?php echo $rs["cityid"]; ?>'><?php echo $rs["cityname"]; ?></option>
			<?php
				}
			?>
			
		</select><span id="d3" class="error"></span>
 </td>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
		<td>&nbsp;</td>
		<td style="padding=5px"><input type="Submit" class="tbox" value="Submit" name="b1" style="width:150px;">
		<input type="Reset" value="Cancel" name="b2" class="tbox" style="width:150px;"></td>
</tr>

</table>
</form>
<br>
<?php
 	if(isset($_GET["y"]))
	{
?>	
		<font color="red"><b>This Area is already exist.</b></font>
<?php
	}
?>
<br>
<?php
	include("dbconnection.php");
	$rs=$obj->query("select * from area a,city c,state s where c.stateid=s.stateid AND a.cityid=c.cityid");
?>
<span class="table">Area Details</span>
<br>
<br>
<table class="tbl" border=2>
<tr>
	
	<td style="padding:10px;font-size:18px"><b><u>Area Name</u></b></td>
	<td style="padding:10px;font-size:18px"><b><u>Pincode</u></b></td>
	<td style="padding:10px;font-size:18px"><b><u>City Name</u></b></td>
	<td style="padding:10px;font-size:18px"><b><u>State Name</u></b></td>
	<td style="padding:10px;font-size:18px"><b><u>Delete</u></b></td>
	<td style="padding:10px;font-size:18px"><b><u>Edit</u></b></td>
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
				
				<td style="padding:10px;font-size:18px"><?php echo $db["areaname"]; ?></td>
				<td style="padding:10px;font-size:18px"><?php echo $db["pincode"]; ?></td>
				<td style="padding:10px;font-size:18px"><?php echo $db["cityname"]; ?></td>
				<td style="padding:10px;font-size:18px"><?php echo $db["statename"]; ?></td>
				<td style="padding:10px;font-size:18px" width="6%"><a href='deletearea.php?x=<?php echo $db["areaid"]; ?>' onclick="return confirm('You sure you want to delete <?php echo $db["areaname"]; ?>?'); "><img src="image\delete.png" height=30 width=30></a></td>
				<td style="padding:10px;font-size:18px" width="6%"><a href='editarea.php?x=<?php echo $db["areaid"]; ?>' onclick="return confirm('You sure you want to edit <?php echo $db["areaname"]; ?>?'); "><img src="image\edit.png" height=30 width=30></a></td>
			</tr>
	<?php
	   }
	?>
</table>
<?php
	include("adminfooter.php");
?></center>