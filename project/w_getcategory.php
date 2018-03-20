<?php

	
	include("dbconnection.php");
     $rs=$obj->query("select *from category_table");
	 $flag=0;
	 $i=0;
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('catid'=>$rd["cat_id"],'catname'=>$rd["cat_name"]);
	    
		 $flag=1;
		 $i++;
	 }
	 
	 if($flag==0)
	 {
		 
		 $data[0]=array("catid"=>"not found");
		 $arr=array('messages'=>$data);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('messages'=>$data);
		 echo json_encode($arr);
		
	}
	 
	 
	?>