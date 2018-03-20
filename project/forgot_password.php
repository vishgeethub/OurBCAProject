<?php
	include("forgotpassheader.php");
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
	.tbox{
		border:2px solid #b3b3b3;
		background:#dddddd;
		width:200px;
		border-radius:15px;
		font-size:18px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
</style>
<script>
function check()
	{
		var l=document.f1.t1.value;
		flag=true;
		if(l=="")
		{
			flag=false;
			document.getElementById("d1").innerHTML="Enter LoginID";
		}
		else
		{
			document.getElementById("d1").innerHTML="";
		}
		
	
		return flag;               
	}
</script>
<center>
<form method="post" name="f1" onsubmit="return check();" >
<span class="header"> Forgot Password </span><br><br>
<table>
<tr>
		<td style="font-size:18px"><b>LoginID:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height=38px"><span id="d1" class="error"></span></td>
</tr>
<tr>
		<td>&nbsp;</td>
		<td style="padding:5px"><input type="Submit" class="tbox" value="Submit" name="b1" style="width:150px;" onclick="return confirm('Mail has been sent to your registered emailID!!'); ">
		<input type="Reset" value="Cancel" name="b2" class="tbox" style="width:150px;"></td>
</tr>

</table>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
	include("forgotpassfooter.php");
?>
</center>