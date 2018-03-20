<?php
	include("ngoheader.php");
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
		font-size:25px;
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
	</style>
<script>
function updatepassword()
{
   var op=document.f1.t1.value;
   var np=document.f1.t2.value;
   var rp=document.f1.t3.value;
   var xlog = new XMLHttpRequest();
	 
	 xlog.onreadystatechange = function() {
	   if(this.readyState == 4 && this.status == 200) {
	   alert(this.responseText);
	}
	};
	   xlog.open("GET","ngoupdatepassword.php?op="+op+"&np="+np+"&rp="+rp,true);
	   xlog.send();

}
function check()
	{
		var op=document.f1.t1.value;
		var pswd=document.f1.t2.value;
		var cpswd=document.f1.t3.value;
		flag=true;
		if(op=="")
		{
			flag=false;
			document.getElementById("d1").innerHTML="Enter Old Password";
		}
		else
		{
			document.getElementById("d1").innerHTML="";
		}
		
		if(pswd=="")
		{
			flag=false;
			document.getElementById("d2").innerHTML="Enter New password";
		}
		else
		{
			document.getElementById("d2").innerHTML="";
		}
		if(cpswd=="")
		{
			flag=false;
			document.getElementById("d3").innerHTML="For Confirmation Reenter Password";
		}
		else
		{
			if(pswd==cpswd)
			{
				document.getElementById("d3").innerHTML="";
			}
			else
			{
				flag=false;
				document.getElementById("d3").innerHTML="Password Not matched";
			}
		}
		return flag;               
	}
</script>
<center>
<form method="post" name="f1" onsubmit="return check();">
<span class="header">Change Password</span>
<br>
<br>
<table>
<tr>
		<td><b>Old Password:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" name="t1"  class="tbox" style="width:300px;height:38px"><span id="d1" class="error"></span></td>
		
</tr>
<tr>
		<td><b>New Password:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="password" name="t2"  class="tbox" style="width:300px;height:38px"><span id="d2" class="error"></span></td>
		
</tr>
<tr>
		<td><b>Retype Password:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="password" name="t3"  class="tbox" style="width:300px;height:38px"><span id="d3" class="error"></span></td>
		
</tr>
<tr>
		<td>&nbsp;</td>
		<td><input type="submit" onclick="updatepassword()"  class="tbox" value="Update" name="b1" style="width:150px;">
		<input type="reset" value="Cancel" name="b2"  class="tbox" style="width:150px;"></td>
</tr>

</table>
</form>
<?php
	include("adminfooter.php");
?></center>