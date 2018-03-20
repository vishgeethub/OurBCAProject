<?php
	$eid=$_REQUEST["eid"];
	$uid=$_REQUEST["uid"];
       	
	
	include("dbconnection.php");
         
         $obj->query("DELETE FROM volunteer_table WHERE uid='$uid' AND eventid='$eid'");
	 
		$arr=array('messages'=>'Delete Successfully');
		echo json_encode($arr);
	 
	?>