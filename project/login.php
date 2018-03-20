
<?php
	include("visitorheader.php");
?>
<style>
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
		font-size:18px;
		border-radius:15px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
	</style>

<script>
   function login()
    {
          var l=document.f1.t1.value;
          var p=document.f1.t2.value;
           var xlog = new XMLHttpRequest();
	 
	 xlog.onreadystatechange = function() {
	   if(this.readyState == 4 && this.status == 200) {
	     if(this.responseText=="0")
             {
                   alert("Invalid Loginid And Password");
              }
             else if(this.responseText=="1")
            {
                 window.location="welcomeadmin.php";
              }
             else if(this.responseText=="2")
             {
                 window.location="welcomengo.php";
            }
	    else
	     {
		alert("Please Enter User ID and Password");
		}
	}
	};
	   xlog.open("GET","checklogin.php?l="+l+"&p="+p,true);
	   xlog.send();


    }
</script>
<center>
<form method="post" name="f1">
<span class ="header">Login</span><br><br>
<table>
<tr>
		<td style="font-size:18px"><b>LoginID:</b></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height:38px"></td>
</tr>
<tr>
		<td style="font-size:18px"><b>Password:</b></td>
		<td style="padding:5px"><input type="password" class="tbox" name="t2" style="width:300px;height:38px"></td><td><input type="checkbox">Show Password</td>
</tr>
<tr>
		<td>&nbsp;</td>
		<!--<td style="color:red">Password Must Contain Six Characters/Digits.</td>-->
		
</tr>
<tr>
		<td>&nbsp;</td>
		<td style="padding:5px"><input type="button" onclick="login()" class="tbox" value="Login" name="b1" style="width:150px" >
		<input type="reset" value="Cancel" name="b2" class="tbox" style="width:150px"></td>
</tr>

</table>
</form>
  <br>
<a href="forgot_password.php"><u>Forgot Password?</u></a>
 
   <br>
<br>
<?php
	include("visitorfooter.php");
?>
</center>