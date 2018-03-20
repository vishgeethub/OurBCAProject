
<?php
	include("adminheader.php");
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
<form action="addadmin.php" name="f1" onsubmit="return check(); method="post">
<span class ="header">Login as Admin</span><br><br>
<table>
<tr>
		<td><b>Admin name:</b></td>
		<td style="padding:5px"><input type="text" name="t1" style="width:300px;height:38px"></td>
</tr>
<tr>
		<td><b>Login ID:</b></td>
		<td style="padding:5px"><input type="text" name="t2" style="width:300px;height:38px"></td>
</tr>
<tr>
		<td><b>Password:</b></td>
		<td style="padding:5px"><input type="password" name="t3" style="width:300px;height:38px"></td>
</tr>
<tr>
		<td><b>E-mail:</b></td>
		<td style="padding:5px"><input type="text" name="t4" style="width:300px;height:38px"></td>
</tr>
<tr>
		<td>&nbsp;</td>
		<td style="padding:5px"><input type="Submit" value="Add" name="b1" style="width:150px;">
                     <input type="reset" value="Cancel" style="width:150px;"></tr>

</table>
</form>
  <?php
	include("dbconnection.php");
	$rs=$obj->query("select *From admin_table");
?>
 <br>
 <br>
<span class="table">Admin Details</span>
<br>
<br>
<table border=4 >
<tr>
	<td style="padding:10px"><b><u>Admin name</u></b></td>
	<td style="padding:10px"><b><u>Login ID</u></b></td>
	<td style="padding:10px"><b><u>E-mail ID</u></b></td>
	<td style="padding:10px"><b><u>Delete</u></b></td>
	
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
				
				<td style="padding:10px"><?php echo $db["aname"]; ?></td>
				<td style="padding:10px"><?php echo $db["loginid"]; ?></td>
				<td style="padding:10px"><?php echo $db["emailID"]; ?></td>
				<td style="padding:10px"><a href='deleteadmin.php?x=<?php echo $db["adminid"]; ?>'><img src="image\delete.png"  height=30 width=30></a></td>
				
			</tr>
	<?php
	   }
	?>
</table>
<?php
	include("adminfooter.php");
?>
</center>