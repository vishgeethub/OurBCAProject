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
		font-weight:bolder;
		text-decoration:underline;
	}
	.table{
		color:dark grey;
		font-family:bookman old style;
		font-size:25px;
		font-weight:bolder;
		text-decoration:underline;
	}
		
	</style>
  <center>
<form action="addstate.php" method="post">
<span class ="header">State</span><br><br>
<table>
<tr>
		<td><b>State:</b></td>
		<td style="padding:5px"><input type="text" name="t1" style="width:300px;height:38px"></td>
</tr>
<tr>
		<td>&nbsp;</td>
		<td style="padding:5px"><input type="Submit" value="Submit" name="b1" style="width:150px">
                     <input type="reset" value="Cancel" style="width:150px">
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
<table border=4 >
<tr>
	<td style="padding:10px"><b><u>Stateid</b></u></td>
	<td style="padding:10px"><b><u>State</b></u></td>
	<td style="padding:10px"><b><u>Delete</b></u></td>
	<td style="padding:10px"><b><u>Edit</b></u></td>
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
				<td style="padding:10px"><?php echo $db["stateid"]; ?></td>
				<td style="padding:10px"><?php echo $db["statename"]; ?></td>
				<td style="padding:10px"><a href='deletestate.php?x=<?php echo $db["stateid"]; ?>'><img src="image\delete.png" height=30 width=30></a></td>
				<td style="padding:10px"><a href='editstate.php?x=<?php echo $db["stateid"]; ?>'><img src="image\edit.png" height=30 width=30></a></td>
			</tr>
	<?php
	   }
	?>
</table>
<?php
  include("adminfooter.php");
?></center>