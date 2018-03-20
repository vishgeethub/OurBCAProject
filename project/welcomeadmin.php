<center>
<?php
  include("adminheader.php");
include("dbconnection.php");
$cn=$obj->query("select *from admin_table");
$rs=$cn->fetch();
?>
 
<style>
.header{
		color:dark grey;
		font-family:bookman old style;
		font-size:50px;
		text-decoration:underline;
		}
</style>
<span class="header">Welcome <?php echo $rs["aname"]; ?> to Admin Panel</span><br><br>
<td><br><br><br><br><br><br><br><br><br><br><br></td>
<?php
  include("adminfooter.php");
?></center>