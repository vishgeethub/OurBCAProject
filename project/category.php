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
	<script>
	function check()
	{
		var cat=document.f1.t1.value;
		
		flag=true;
		if(cat=="")
		{
			flag=false;
			document.getElementById("d1").innerHTML="Enter category";
		}
		else
		{
			document.getElementById("d1").innerHTML="";
		}
		return flag;
	}
	</script>
<center>
<form action="addcategory.php" name="f1" onsubmit="return check();" method="post">
<span class="header">Add Category</span>
<br>
<br>
<table>
<tr>
		<td style="font-size:18px;"><b>Category Name:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t1" style="width:300px;height:38px"><span id="d1" class="error" ></span></td>
</tr>
<tr>
		<td>&nbsp;</td>
		<td style="padding:5px"><input type="Submit" class="tbox" value="Add" name="b1" style="width:150px;font-size:18px;">
                     <input type="reset" value="Cancel" class="tbox" style="width:150px;font-size:18px;">
 </td>
</tr>

</table>
</form>
  <br>
<?php
 	if(isset($_GET["y"]))
	{
?>	
		<font color="red"><b>This Category is already exist.</b></font>
<?php
	}
?>
<br>
<?php
	include("dbconnection.php");
	$rs=$obj->query("select *From category_table");
?>
 <br>
 <br>
<snap class="table">Category Details</snap>
<br>
<br>
<table class="tbl" border=2>
<tr>
	<td style="padding:10px;font-size:16px;"><b><u>Category ID</u></b></td>
	<td style="padding:10px;font-size:16px;"><b><u>Category</u></b></td>
	<td style="padding:10px;font-size:16px;"><b><u>Delete</u></b></td>
	<td style="padding:10px;font-size:16px;"><b><u>Edit</u></b></td>
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
			<tr>
				<td style="padding:10px;font-size:16px;"><?php echo $db["cat_id"]; ?></td>
				<td style="padding:10px;font-size:16px;"><?php echo $db["cat_name"]; ?></td>
				<td style="padding:10px;font-size:16px;" width="6%"><a href='deletecategory.php?x=<?php echo $db["cat_id"]; ?>'onclick="return confirm('You sure you want to delete <?php echo $db["cat_name"]; ?> ?'); "><img src="image\delete.png"  height=30 width=30></a></td>
				<td style="padding:10px;font-size:16px;" width="6%"><a href='editcategory.php?x=<?php echo $db["cat_id"]; ?>' onclick="return confirm('You sure you want to edit <?php echo $db["cat_name"]; ?> ?'); "><img src="image\edit.png"  height=30 width=30></a></td>
			</tr>
	<?php
	   }
	?>
</table>
<center>
<?php
  include("adminfooter.php");
?>