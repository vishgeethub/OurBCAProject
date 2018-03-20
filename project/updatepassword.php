<?php
	$op=$_GET["op"];
	$np=$_GET["np"];
	$rp=$_GET["rp"];
	include("dbconnection.php");
         $rs=$obj->query("select *from admin_table where password='$op'");
         if($rd=$rs->fetch())
        {
	$obj->query("update admin_table set password='$np'");
    	echo "Your Password Change Successfully";
         }
         else
          {
              echo "Invalid Old Password";
            }
	header("Location:welcomeadmin.php");
  ?>