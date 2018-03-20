<?php
	$l=$_REQUEST["l"];
	$op=$_REQUEST["op"];
	$newpd=$_REQUEST["newpd"];
	
	
	include("dbconnection.php");
	$rs=$obj->query("select *from user_table where loginid='$l' and password='$op'");
	
	if($rd=$rs->fetch())
	{
		$obj->query("update user_table set password='$newpd' where loginid='$l' ");
		$arr=array('messages'=>'1');
		echo json_encode($arr);
	}
	else
	{
		$arr=array('messages'=>'0');
		echo json_encode($arr);
	}