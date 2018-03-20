<?php
	$uid=$_REQUEST["uid"];
	$feedback=$_REQUEST["feedback"];
    $date=date('Y-m-d');	
	
	include("dbconnection.php");
         
        $obj->query("insert into feedback_table(uid,feedback,feedbackdate) values('$uid','$feedback','$date')");
	 
		$arr=array('messages'=>'Feedback Successfull');
		echo json_encode($arr);
	 
	?>