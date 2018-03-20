
<?php
	include("visitorheader.php");
?>
<style>
	.header{
		color:dark grey;
		font-family:bookman old style;
		font-size:50px;
		font-weight:bolder;
		text-decoration:underline;
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
		<td><b>LoginID:</b></td>
		<td style="padding:5px"><input type="text" name="t1" style="width:300px;height:38px"></td>
</tr>
<tr>
		<td><b>Password:</b></td>
		<td style="padding:5px"><input type="password" name="t2" style="width:300px;height:38px"></td>
</tr>
<tr>
		<td>&nbsp;</td>
		<td style="padding:5px"><input type="button" onclick="login()" value="Login" name="b1" style="width:150px" >
		<input type="reset" value="Cancel" name="b2" style="width:150px"></td>
</tr>

</table>
</form>
  <br>
   <br>
   <a href="forgot_password.php"><u>Forgot Password?</a></u>
<?php
	include("visitorfooter.php");
?>
/center>