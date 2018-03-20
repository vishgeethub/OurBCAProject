<?php
	include("adminheader.php");
	include("dbconnection.php");
	$id=$_GET["x"];
	$rd=$obj->query("select *From state where stateid='$id' ");
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
		font-size:35px;;
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
<form action="updatestate.php" method="post">
<span class="header">Edit State</span>
<input type="hidden" value='<?php echo $rdc["stateid"]; ?>' name="id">
<table>
<tr>
	<td style="font-size:18px"><b>StateName:</b></td>
	<td style="padding=5px"><input type="text" class="tbox" style="width:300px;height:38px" value='<?php echo $rdc["statename"]; ?>' name="t1"></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="Update" class="tbox" style="width:150px"></td>
</tr>
</table>



<br>
  <br>
    <?php
      $rs=$obj->query("select *From state");

     ?>
<span class="table">State Details</span>
<table class="tbl" border="2">
         <tr>
             
             <td style="padding:10px;font-size:16px"><b><u>State Name</b></u></td>
             <td style="padding:10px;font-size:16px"><b><u>Delete</b></u></td>
             <td style="padding:10px;font-size:16px"><b><u>Edit</b></u></td>

         </tr>
             <?php
                 while($rd=$rs->fetch())
                   {
              ?>
                     <tr>
                        
                        <td style="padding:10px;font-size:16px"><?php echo $rd["statename"]; ?></td>
                        <td style="padding:10px;font-size:16px" width="6%"><a href='deletestate.php?x=<?php echo $rd["stateid"]; ?>'><img src="image\delete.png" height=30 width=30></a></td>
                        <td style="padding:10px;font-size:16px" width="6%"><a href='editstate.php?x=<?php echo $rd["stateid"]; ?>'><img src="image\edit.png" height=30 width=30></a></td>
                     </tr>
                <?php
                  }
               ?>
   
     </table>
<?php
	include("adminfooter.php");
?></center>