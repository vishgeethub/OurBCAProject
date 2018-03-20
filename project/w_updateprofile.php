<?php
	$ad=$_REQUEST["address"];
	$ph=$_REQUEST["phone"];
	$rid=$_REQUEST["rid"];
	
	include("dbconnection.php");
         if($_FILES["photo"]["name"]=="")
		 {
			    $obj->query("update user_table set address='$ad',phone='$ph' where uid='$rid'");
		
		 }
		 else
		 {
			 
		 $path="image/".$_FILES["photo"]["name"];
         move_uploaded_file($_FILES["photo"]["tmp_name"],$path);
         $obj->query("update user_table set address='$ad',phone='$ph',profilepic='$path' where uid='$rid'");
		 }
		 
		$arr=array('messages'=>'Profile Updated Successfully');
		echo json_encode($arr);
	 
	?>