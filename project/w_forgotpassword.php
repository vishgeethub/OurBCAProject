<?php
	$l=$_REQUEST["l"];
	
	
	include("dbconnection.php");
    $rs=$obj->query("select *from user_table where loginid='$l'");
	 
	if($rd=$rs->fetch())
	{
		 
		$arr=array('messages'=>$rd["uid"],'name'=>$rd["uname"],'phone'=>$rd["phone"],'loginid'=>$rd["loginid"],'password'=>$rd["password"]);
	    echo json_encode($arr);
	}
	else
	{
		$arr=array('messages'=>'Invalid LoginID');
		echo json_encode($arr);
	}
	 
	 
	?>