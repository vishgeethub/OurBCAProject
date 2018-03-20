<?php

	
	include("dbconnection.php");
     $rs=$obj->query("select *from advertisement_table");
	 
	 
	 if($rd=$rs->fetch())
	 {
		 
		 $arr=array('advertisementid'=>$rd["advertisementid"],'photo'=>$rd["photo"],'navigateurl'=>$rd["navigateURL"],);
	     echo json_encode($arr);
	 }
	 else
	 {
		 $arr=array('advertisementid'=>'not found');
     echo json_encode($arr);
		
	}
	 
	 
	?>