<?php

	$sid=$_REQUEST["stateid"];
	include("dbconnection.php");
     $rs=$obj->query("select *from city where stateid='$sid'");
	 $flag=0;
	 $i=0;
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('cityid'=>$rd["cityid"],'name'=>$rd["cityname"]);
	    
		 $flag=1;
		 $i++;
	 }
	 
	 if($flag==0)
	 {
		 
		 $data[0]=array("cityid"=>"not found");
		 $arr=array('messages'=>$data);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('messages'=>$data);
		 echo json_encode($arr);
		
	}
	 
	 
	?>