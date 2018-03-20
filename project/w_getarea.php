<?php

	 $cid=$_REQUEST["cityid"];
	include("dbconnection.php");
     $rs=$obj->query("select *from area where cityid='$cid'");
	 $flag=0;
	 $i=0;
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('areaid'=>$rd["areaid"],'name'=>$rd["areaname"]);
	    
		 $flag=1;
		 $i++;
	 }
	 
	 if($flag==0)
	 {
		 
		 $data[0]=array("areaid"=>"not found");
		 $arr=array('messages'=>$data);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('messages'=>$data);
		 echo json_encode($arr);
		
	}
	 
	 
	?>