<?php session_start();
	$op=$_GET["op"];
	$np=$_GET["np"];
	$rp=$_GET["rp"];
	$id=$_SESSION["nid"];
	include("dbconnection.php");
         $rs=$obj->query("select *from ngo_table where NGOid='$id'");
	
         if($rd=$rs->fetch())
        {
		
		$obj->query("update ngo_table set password='$np' where NGOid='$id' AND password='$op'");
    	 	echo "Your Password Changed Successfully";
         }
         else
          {
              echo "Invalid Old Password";
            }
	header("Location:welcomengo.php");
  ?>