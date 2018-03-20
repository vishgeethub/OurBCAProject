<?php
  include("ngoheader.php");
  include("dbconnection.php");
  $aid=$_GET["x"];
  ?>
<center>
<style>	
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
		
	</style>
<form action="addphoto.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="aid" value='<?php echo "$aid" ?>'>
<span class ="header">Add Photos</span><br>
<br>
<table>
<tr>		
		<td><b>Photo:</b></td>
		<td style="padding:5px"><input type="file" class="tbox" name="t1" style="width:300px"></td>
</tr>
<tr>
        <td><b>Description:</b></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t2" style="width:300px;height:38px"></td>
</tr>		
<tr>
		<td>&nbsp;</td>

		<td style="padding:5px"><input type="Submit" class="tbox" value="Add" name="b1" style="width:150px" >
        <input type="reset" value="Cancel" class="tbox" style="width:150px"></td>
</tr>
</table>
</center>
</form>
  
<?php
	include("dbconnection.php");
	$rs=$obj->query("select *From photo_gallery where album_id='$aid'");
?>
<br>
<br>
<center>
<span class ="table">Show Photos</span><br><br>
<table class="tbl" border=2>
<tr>
	<td style="padding:10px"><b><u>Photos</u></b></td>
	<td style="padding:10px"><b><u>Description</u></b></td>
	<td style="padding:10px"><b><u>Delete</u></b></td>
	<td style="padding:10px"><b><u>Edit</u></b></td>
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
			<td style="padding:10px"><img src='<?php echo $db["photo"]; ?>' width=50px height=50px></td>
			<td style="padding:10px"><?php echo $db["description"]; ?></td>
			<td style="padding:10px"><a href='deletephoto.php?x=<?php echo $db["galleryid"]; ?>.$aid' onclick="return confirm('You sure you want to delete?');"><img src="image\delete.png"  height=30 width=30></a></td>
			<td style="padding:10px"><a href='editphoto.php?x=<?php echo $db["galleryid"]; ?>' onclick="return confirm('You sure you want to edit?'); "><img src="image\edit.png" height=30 width=30></a></td>
			</tr>
	<?php
	   }
	?>
</table>
</center>
<?php
  include("ngofooter.php");
?>