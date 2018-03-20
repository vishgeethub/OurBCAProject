<?php
	include("adminheader.php");
	include("dbconnection.php");
	$db = $obj->query("select * from advertiser_table");
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
<script>
function validateEmail(email) 
	{
		var x = email;
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        return false;
		}
		else
		{
			return true;
		}
	}
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
			document.getElementById(dname).innerHTML="Invalid Digit";
        }
        else
        {
            document.getElementById(dname).innerHTML="";
    
        }     
	}
	function check()
	{
		var advertiser=document.f1.t1.value;
		var companyname=document.f1.t2.value;
		var contactno=document.f1.t3.value;
		var emailid=document.f1.t4.value;
		flag=true;
		if(advertiser=="")
		{
			flag=false;
			document.getElementById("d1").innerHTML="Advertiser name required";
		}
		else
		{
			document.getElementById("d1").innerHTML="";
		}
		if(companyname=="")
		{
			flag=false;
			document.getElementById("d2").innerHTML="Company name required";
		}
		else
		{
			document.getElementById("d2").innerHTML="";
		}
		if(contactno=="")
		{
			flag=false;
			document.getElementById("d3").innerHTML="Enter contact no";
		}
		else
		{
			document.getElementById("d3").innerHTML="";
		}
		if(emailid=="")
		{
			flag=false;
			document.getElementById("d4").innerHTML="Enter e-mailid";
		}
		else
		{
			if(validateEmail(emailid))
			{
				document.getElementById("d4").innerHTML="";
			}
			else
			{
				flag=false;
				document.getElementById("d4").innerHTML="Invalid Emailid"; 
			}
		}
		return flag;
	}
	</script>
<center>
<span class="header">Add Advertiser</span>
<br>
<br>
<form action="add_advertiser.php" onsubmit="return check();" method="post"name="f1">

<table>
<tr>
		<td style="font-size:18px;"><b>Advertiser Name:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height:38px">
		<span id="d1" class="error"></span></td>
</tr>
<tr>
		<td style="font-size:18px;"><b>Company Name:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t2" style="width:300px;height:38px">
		<span id="d2" class="error"></span></td>
</tr>
<tr>
		<td style="font-size:18px;"><b>Contact No:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t3" onKeyUp="checknumber(this.value,'d3');" style="width:300px;height:38px">
		<span id="d3" class="error"></span></td>
</tr>
<tr>
		<td style="font-size:18px;"><b>Email ID:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t4" style="width:300px;height:38px">
		<span id="d4" class="error"></span></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
		<td>&nbsp;</td>
		<td><input type="Submit" value="Submit" name="b1" class="tbox" style="width:150px;font-size:18px;">
		
		<input type="Reset" value="Cancel" name="b2" class="tbox" style="width:150px;font-size:18px;"></td>
</tr>

</table>
</form>
<br>
<?php
 	if(isset($_GET["y"]))
	{
?>	
		<font color="red"><b>This Advertiser is already exist.</b></font>
<?php
	}
?>
<br>
<br>
<br>
<span class="table">Advertiser Details</span>
<br>
<br>
<table class="tbl" border="2">
<tr>
	<!--<td style="padding:10px"><u><b>Advertiser ID</u></b></td>-->
	<td style="padding:10px;font-size:16px;"><u><b>Advertiser Name</u></b></td>
	<td style="padding:10px;font-size:16px;"><u><b>Company Name</u></b></td>
	<td style="padding:10px;font-size:16px;"><u><b>Contact No.</u></b></td>
	<td style="padding:10px;font-size:16px;"><u><b>Email ID</u></b></td>
	<td style="padding:10px;font-size:16px;"><u><b>Edit</u></b></td>
	<td style="padding:10px;font-size:16px;"><u><b>Delete</u></b></td>
</tr>
	<?php
		while($dbs=$db->fetch())
		{
	?>
		<tr>
			<!--<td style="padding:10px"><?php echo $dbs["advertiserid"]; ?></td>-->
			<td style="padding:10px;font-size:16px;"><?php echo $dbs["name"]; ?></td>
			<td style="padding:10px;font-size:16px;"><?php echo $dbs["companyname"]; ?></td>
			<td style="padding:10px;font-size:16px;"><?php echo $dbs["contactno"]; ?></td>
			<td style="padding:10px;font-size:16px;"><?php echo $dbs["emailid"]; ?></td>
			<td style="padding:10px;font-size:16px;" width="6%"><a href='editadvertiser.php?x=<?php echo $dbs["advertiserid"]; ?>' onclick="return confirm('You sure you want to edit?'); "><img src="image\edit.png" height=30 width=30></a></td>
			<td style="padding:10px;font-size:16px;" width="6%"><a href='deleteadvertiser.php?x=<?php echo $dbs["advertiserid"]; ?>' onclick="return confirm('You sure you want to delete?'); "><img src="image\delete.png" height=30 width=30></a></td>
		</tr>
	<?php
		}
	?>
</table>
</center>
<?php
	include("adminfooter.php");
?>