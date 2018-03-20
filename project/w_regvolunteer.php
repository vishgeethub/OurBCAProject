<?php
	$eid=$_REQUEST["eid"];
	$uid=$_REQUEST["uid"];
        $rdate=date('Y-m-d');
        $status=1;	
	
	include("dbconnection.php");
         
         $obj->query("insert into volunteer_table(eventid,uid,rdate,status) values('$eid','$uid','$rdate','$status')");
	 
		$arr=array('messages'=>'Register Successfully');
		echo json_encode($arr);
	 
	?>