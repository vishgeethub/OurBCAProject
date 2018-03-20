<?php
	include("adminheader.php");
	include("dbconnection.php");
	$id=$_GET["x"];
	$rd=$obj->query("select *From city where cityid='$id' ");
	$rdc=$rd->fetch();
        $db=$obj->query("select *From state");
?>
<center>
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
<form action="updatecity.php" method="post">
<span class="header">Edit City</span>
<br>
<br>
<input type="hidden" value='<?php echo $rdc["cityid"]; ?>' name="id">
<table>
<tr>
  <td style="font-size:18px"><b>City:</b></td>
   <td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height:38px" value='<?php echo $rdc["cityname"]; ?>'></td>
</tr>
<tr>
	<td style="font-size:18px"><b>State:</b></td>
	<td style="padding:5px">
          <select name="t2" class="tbox" style="width:300px;height:38px">
			<option value="0">---Select State---</option>
			<?php
				while($rs=$db->fetch())
				{
                                       if($rdc["stateid"]==$rs["stateid"])
                                      {
			?>
				<option selected value='<?php echo $rs["stateid"]; ?>'><?php echo $rs["statename"]; ?></option>
			<?php
                                      }
                                      else
                                      {
                                         ?>
				<option  value='<?php echo $rs["stateid"]; ?>'><?php echo $rs["statename"]; ?></option>

                                          <?php
                                         }
				}
			?>
			
		</select>
        </td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" class="tbox" value="Update" style="width:150px"></td>
</tr>
</table>



<br>
  <br>

<?php
	include("dbconnection.php");
	$rs=$obj->query("select * From city c,state s where c.stateid=s.stateid");
?>
<span class="table" >City Details</span>
<br>
<br>
<table class="tbl" border=2>

<tr>
	
	<td style="padding:10px;font-size:16px"><b><u>City_Name</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>State_Name</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Delete</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Edit</b></u></td>
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
				
				<td style="padding:10px;font-size:16px"><?php echo $db["cityname"]; ?></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["statename"]; ?></td>
				<td style="padding:10px;font-size:16px" width="6%"><a href='deletecity.php?x=<?php echo $db["cityid"]; ?>'><img src="image\delete.png" height=30 width=30></a></td>
				<td style="padding:10px;font-size:16px" width="6%"><a href='editcity.php?x=<?php echo $db["cityid"]; ?>'><img src="image\edit.png" height=30 width=30></a></td>
			</tr>
	<?php
	   }
	?>
</table>
<?php
	include("adminfooter.php");
?>
</center>