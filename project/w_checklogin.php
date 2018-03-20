<?php
	$l=$_REQUEST["l"];
	$p=$_REQUEST["p"];
	
	include("dbconnection.php");
    $rs=$obj->query("select *from user_table where loginid='$l' and password='$p'");
	 
	if($rd=$rs->fetch())
	{
		 
		$arr=array('messages'=>$rd["uid"],'name'=>$rd["uname"],'profilepic'=>$rd["profilepic"]);
	    echo json_encode($arr);
	}
	else
	{
		$arr=array('messages'=>'0');
		echo json_encode($arr);
	}
	 
	 
	?>