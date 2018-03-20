<?php
	include("adminheader.php");
	include("dbconnection.php");
	$id=$_GET["x"];
	$rd=$obj->query("select *From area where areaid='$id' ");
	$rdc=$rd->fetch();
        $db=$obj->query("select *From city");
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
<center>
<form action="updatearea.php" method="post">
<span class="header">Edit Area</span>
<br>
<br>
<input type="hidden" value='<?php echo $rdc["areaid"]; ?>' name="id">
<table>
<tr>
  <td style="font-size:18px;"><b>Areaname:</b></td>
   <td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height:38px" value='<?php echo $rdc["areaname"]; ?>'></td>
</tr>
<tr>
  <td style="font-size:18px;"><b>Pincode:</b></td>
   <td style="padding:5px"><input type="text" class="tbox" name="t2" style="width:300px;height:38px" value='<?php echo $rdc["pincode"]; ?>'></td>
</tr>
<tr>
	<td style="font-size:18px;"><b>City:</b></td>
	<td style="padding:5px">
          <select name="t3" class="tbox" style="width:300px;height:38px">
			<option value="0">---Select City---</option>
			<?php
				while($rs=$db->fetch())
				{
                                       if($rdc["cityid"]==$rs["cityid"])
                                      {
			?>
				<option selected value='<?php echo $rs["cityid"]; ?>'><?php echo $rs["cityname"]; ?></option>
			<?php
                                      }
                                      else
                                      {
                                         ?>
				<option  value='<?php echo $rs["cityid"]; ?>'><?php echo $rs["cityname"]; ?></option>

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
	<td><input type="submit" class="tbox" value="Update" style="width:150px;font-size:18px;"></td>
</tr>
</table>
</form>
<br>
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
	
	<td style="padding:10px;font-size:16px"><b><u>Area_Name</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Pincode</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>City_Name</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>State_Name</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Delete</b></u</td>
	<td style="padding:10px;font-size:16px"><b><u>Edit</u></b></td>
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
				
				<td style="padding:10px;font-size:16px"><?php echo $db["areaname"]; ?></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["pincode"]; ?></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["cityname"]; ?></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["statename"]; ?></td>
				<td style="padding:10px;font-size:16px" width="6%"><a href='deletearea.php?x=<?php echo $db["areaid"]; ?>'><img src="image\delete.png" height=30 width=30></a></td>
				<td style="padding:10px;font-size:16px" width="6%"><a href='editarea.php?x=<?php echo $db["areaid"]; ?>'><img src="image\edit.png" height=30 width=30></a></td>
			</tr>
	<?php
	   }
	?>
</table>
<?php
	include("adminfooter.php");
?>
</center>