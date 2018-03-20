<center>
<?php session_start();
  include("ngoheader.php");
  $id=$_SESSION["nid"];
    include("dbconnection.php");
   $rs=$obj->query("select *from ngo_table where NGOid='$id'");
   $rd=$rs->fetch();
 
 ?>
<style>
.header{
		color:dark grey;
		font-family:bookman old style;
		font-size:50px;
		text-decoration:underline;
		}
</style>

  
<span class="header"> Welcome NGO <?php echo $rd["NGOname"]; ?></span>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
  include("ngofooter.php");
?></center>