<?php
  include("adminheader.php");
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
		font-size:18px;
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
<form action="addstate.php" method="post">
<span class ="header">State</span><br><br>
<table>
<tr>
		<td style="font-size:18px"><b>State:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height:38px"></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>

<tr>
		<td>&nbsp;</td>
		<td style="padding:5px"><input type="Submit" class="tbox" value="Submit" name="b1" style="width:150px">
                     <input type="reset" value="Cancel" class="tbox" style="width:150px">
 </td>
</tr>

</table>
</form>
<br>
<?php
       if(isset($_GET["y"]))
	   {
		     ?>
			 <font color="red"><b>This state is already exist</b></font>
			 <?php
	   }
   ?>
  
  <br>
<?php
	include("dbconnection.php");
	$rs=$obj->query("select *From state");
?>
 <br>
 <br>
 <span class ="table">State Details</span><br><br>
<table class="tbl" border=2 >
<tr>
	
	<td style="padding:10px;font-size:16px"><b><u>State</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Delete</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Edit</b></u></td>
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
				
				<td style="padding:10px;font-size:16px" width="50%"><?php echo $db["statename"]; ?></td>
				<td style="padding:10px;font-size:16px" width="6%"><a href='deletestate.php?x=<?php echo $db["stateid"]; ?>' onclick="return confirm('You sure you want to delete <?php echo $db["statename"]; ?> ?'); "><img src="image\delete.png" height=30 width=30></a></td>
				<td style="padding:10px;font-size:16px" width="6%"><a href='editstate.php?x=<?php echo $db["stateid"]; ?>' onclick="return confirm('You sure you want to edit <?php echo $db["statename"]; ?> ?'); "><img src="image\edit.png" height=30 width=30></a></td>
			</tr>
	<?php
	   }
	?>
</table>
<?php
  include("adminfooter.php");
?></center>