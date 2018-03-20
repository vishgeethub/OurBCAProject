<?php
	$nid=$_REQUEST["nid"];
	$uid=$_REQUEST["uid"];
	$amount=$_REQUEST["amount"];
	$adhar=$_REQUEST["adhar"];
	$purpose=$_REQUEST["purpose"];
        $date=date('Y-m-d');	
	
	include("dbconnection.php");
         
         $obj->query("insert into charity_table(uid,NGOid,amount,adhar_no,purpose,charitydate) values('$uid','$nid','$amount','$adhar','$purpose','$date')");
	 
		$arr=array('messages'=>'Charity Successfull');
		echo json_encode($arr);
	 
	?>