<?php
  include("ngoheader.php");
  include("dbconnection.php");
  $cat=$obj->query("select * from event_table");
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

<script>
	function check()
	{
		var albumname=document.f1.t1.value;
		var coverpage=document.f1.t6.value;
		var event=document.f1.event.value;
		flag=true;
		if(albumname=="")
		{
			flag=false;
			document.getElementById("d1").innerHTML="Enter album name";
		}
		else
		{
			document.getElementById("d1").innerHTML="";
		}
		if(coverpage=="")
		{
			flag=false;
			document.getElementById("d2").innerHTML="Upload Cover Page Picture";
		}
		else
		{
			document.getElementById("d2").innerHTML="";
		}
		if(event=="0")
		{
			flag=false;
			document.getElementById("d3").innerHTML="Select event";
		}
		else
		{
			document.getElementById("d3").innerHTML="";
		}
		return flag;
	}
		
</script>
<center>
<form action="addalbum.php" method="post" onsubmit="return check();" name="f1" enctype="multipart/form-data">
<span class="header">Album</span>
<br>
<table>
<tr>
		<td style="font-size:18px;"><b>Album Name:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height:38px">
		<span id="d1" class="error"></span></td>
</tr>
<tr>
		<td style="font-size:18px;"><b>Cover Page:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="file" class="tbox" name="t6" style="width:300px;">
		<span id="d2" class="error"></span></td>
</tr>
<tr>
		<td style="font-size:18px;"><b>Event:</b><span style="color:red">*</span></td>
		<td style="padding:5px">
		<select name="event" class="tbox" style="width:300px;height:38px">
			<option value="0">---Select Event---</option>
		<?php
			while($rs=$cat->fetch())
			{
		?>
			<option value='<?php echo $rs["eventid"]; ?>'><?php echo $rs["eventname"]; ?></option>
		<?php
			}
		?>
		</select><span id="d3" class="error"></span>
<tr>
		<td>&nbsp;</td>
		<td style="padding:5px"><input type="Submit" class="tbox" value="Submit" name="b1" style="width:150px;font-size:18px;">
                     <input type="reset" value="Cancel" class="tbox" style="width:150px;font-size:18px;"">
 </td>
</tr>

</table>
</form>
  <br>
<?php
 	if(isset($_GET["y"]))
	{
?>	
		<font color="red"><b>This Album is already exist.</b></font>
<?php
	}
?>

<?php
	include("dbconnection.php");
	$rs=$obj->query("select *From album_table a,event_table e where a.eventid=e.eventid");
?>
<br>
<br>
<br>
<span class="table">Album Details</span>
<br>
<br>
<table class="tbl" border=2>
<tr>
	<td style="padding:10px;font-size:16px"><b><u>Album Name</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Coverpage</b></u></td>
	<td style="padding:10px;font-size:16px"><b><u>Event Name</b></u></td>
	<td style="padding:10px;font-size:16px"><u><b>Delete</u></b></td>
	<td style="padding:10px;font-size:16px"><u><b>Add Images</u></b></td>
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
			<td style="padding:10px;font-size:16px"><?php echo $db["album_name"]; ?></td>
			<td style="padding:10px;font-size:16px"><img src='<?php echo $db["coverpage"]; ?>' width=50px height=50px></td>
			<td style="padding:10px;font-size:16px"><?php echo $db["eventname"]; ?></td>
			<td style="padding:10px;font-size:16px"><a href='deletealbum.php?x=<?php echo $db["album_id"]; ?>' onclick="return confirm('You sure you want to delete?'); "><img src="image\delete.png"  height=30 width=30></a></td>
			<td style="padding:10px;font-size:16px"><a href='photo.php?x=<?php echo $db["album_id"]; ?>'"><img src="image\addphoto.png" height=30 width=30></a></td>
			</tr>
	<?php
	   }
	?>
</table>
</center>
<?php
  include("ngofooter.php");
?>