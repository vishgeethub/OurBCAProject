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
		font-size:18px;
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
	<script>
	function check()
	{
		var desc=document.f1.t1.value;
		var sd=document.f1.t3.value;
		
		flag=true;
		if(desc=="")
		{
			flag=false;
			document.getElementById("d1").innerHTML="Enter description";
		}
		else
		{
			document.getElementById("d1").innerHTML="";
		}
		if(sd=="")
		{
			flag=false;
			document.getElementById("d3").innerHTML="Enter short description for mobile application";
		}
		else
		{
			document.getElementById("d3").innerHTML="";
		}
	return flag;               
	}		
	</script>
<center>
<form action="addnews.php" onsubmit="return check();" method="post" name="f1" enctype="multipart/form-data"> 
<span class ="header">Add News</span><br><br>
<table>
<tr>
	<td style="font-size:18px"><b>Description:</b><span style="color:red">*</td>
	<td style="padding=5px"><textarea rows="5"class="tbox" cols="25" name="t1" style="width:300px;height:75px"></textarea>
<span id="d1" class="error"></span>
	</td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
	<td style="font-size:18px"><b>Photo:</b></td>
	<td style="padding=5px"><input type="file" class="tbox" name="i1" style="width:300px;height=90px"></td>
 </tr>
<tr>
<td><br></td>
</tr>
<tr>
	<td style="font-size:18px"><b>Short Description:</b><span style="color:red">*</td>
	<td style="padding=5px"><textarea rows="3" class="tbox" cols="25" name="t3" style="width:300px;height:50px"></textarea>
<span id="d3" class="error"></span><br>
	</td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="Submit" class="tbox" name="b1" style="width:150px">	
	<input type="reset" value="Cancel" name="b2" class="tbox" style="width:150px"><br></td>

</tr>
<td><br></td>
</table>
</form>
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
<td style="padding:10px;font-size:16px" width="9%"><?php $org=$db["newsdate"]; echo date("d-m-Y", strtotime($org)) ?></td>

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