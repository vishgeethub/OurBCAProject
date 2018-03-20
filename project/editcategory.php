<?php
	include("adminheader.php");
	include("dbconnection.php");
	$id=$_GET["x"];
	$rd=$obj->query("select *From category_table where cat_id='$id' ");
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
<form action="updatecategory.php" method="post">
<span class="header">Edit category</span>

<br>
<br>
<input type="hidden" value='<?php echo $rdc["cat_id"]; ?>' name="id">
<table>
<tr>
	<td style="font-size:18px;"><b>Category Name:</b></td>
	<td style="padding=5px"><input type="text" class="tbox" style="width:300px;height:38px" value='<?php echo $rdc["cat_name"]; ?>' name="t1"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="Update" class="tbox" style="width:150px;font-size:18px"></td>
</tr>
</table>



<br>
  <br>
    <?php
      $rs=$obj->query("select *From category_table");
     ?>
<span class="table" > Category Details</span>
<br>
<br>
<table class="tbl" border="2">
         <tr>
             <td style="padding:10px;font-size:16px"><b><u>Category ID</b></u></td>
             <td style="padding:10px;font-size:16px"><b><u>Category Name</b></u></td>
             <td style="padding:10px;font-size:16px" width="6%"><b><u>Delete</b></u></td>
             <td style="padding:10px;font-size:16px" width="6%"><b><u>Edit</b></u></td>

         </tr>
             <?php
                 while($rd=$rs->fetch())
                   {
              ?>
                     <tr>
                        <td style="padding:10px;font-size:16px"><?php echo $rd["cat_id"]; ?></td>
                        <td style="padding:10px;font-size:16px"><?php echo $rd["cat_name"]; ?></td>
                        <td style="padding:10px;font-size:16px"><a href='deletecategory.php?x=<?php echo $rd["cat_id"]; ?>'><img src="image\delete.png"  height=30 width=30></a></td>
                        <td style="padding:10px;font-size:16px"><a href='editcategory.php?x=<?php echo $rd["cat_id"]; ?>'><img src="image\edit.png"  height=30 width=30></a></td>
                     </tr>
                <?php
                  }
               ?>
   
     </table>
<?php
	include("adminfooter.php");
?></center>