<?php
	include("adminheader.php");
	include("dbconnection.php");
	$id=$_GET["x"];
	$rd=$obj->query("select *From news_table where newsid='$id' ");
	$rdc=$rd->fetch();
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
		font-size:16px;
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
<form action="updatenews.php" method="post" enctype="multipart/form-data">
<span class="header">Edit News</span>
<input type="hidden" value='<?php echo $rdc["newsid"]; ?>' name="id">
<table>
<tr>
  	<td style="font-size:18px"><b>Description</b></td>
	<td style="padding=5px"><textarea rows="5"class="tbox" cols="25" name="t1" 		style="width:300px;height:75px"><?php echo $rdc["description"]; ?></textarea></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
	<td style="font-size:18px"><b>Photo:</b></td>
	<td style="padding=5px"><input type="file" class="tbox" name="i1" 	style="width:300px;height=90px"><img src='<?php echo $rdc["photo"]; ?>' width="70px" height="70px"></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
	<td style="font-size:18px"><b>Short Description:</b><span style="color:red">*</td>
	<td style="padding=5px"><textarea rows="3" class="tbox" cols="25" name="t3" style="width:300px;height:50px"><?php echo $rdc["short_desc"]; ?></textarea></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="Update" class="tbox" style="width:150px">&nbsp;<input type="button" value="Cancel" class="tbox" style="width:150px"></td>
</tr>
<tr>
<td><br></td>
</tr>
</table>
<?php
	include("dbconnection.php");
	$rs=$obj->query("select *From news_table order by newsdate desc");
?>
<span class ="table">News Details</span>
<br>
<br>
<table class="tbl" border=2>
<tr>
	<td style="padding:10px;font-size:16px"><b><u>News Title</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>Description</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>Photo</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>News Date</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>Delete</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>Edit</u></b></td>
	
	
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
	<tr>
				<td style="padding:10px;font-size:16px" width="14%"><?php echo $db["short_desc"]; ?></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["description"]; ?></td>
				<td style="padding:10px;font-size:16px"><img src='<?php echo $db["photo"]; ?>' height=100 width=100></td>
<td style="padding:10px" width="9%"><?php $org=$db["newsdate"]; echo date("d-m-Y", strtotime($org)) ?></td>

				<td style="padding:10px;font-size:16px" width="6%"><a href='deletenews.php?x=<?php echo $db["newsid"]; ?>' onclick="return confirm('You sure you want to delete?'); "><img src="image\delete.png"  height=30 width=30></a></td>
				<td style="padding:10px;font-size:16px" width="6%"><a href='editnews.php?x=<?php echo $db["newsid"]; ?>' onclick="return confirm('You sure you want to edit?'); "><img src="image\edit.png"  height=30 width=30></a></td>
			
			</tr>
	<?php
	   }
	?>
</table>
<?php
	include("adminfooter.php");
?></center>