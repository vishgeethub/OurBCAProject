<?php
	$ngoid=$_REQUEST["ngoid"];
	include("dbconnection.php");
     	$rs=$obj->query("select *from event_table where NGOid='$ngoid'");
		 $flag=0;
	 	$i=0;
	 while($rd=$rs->fetch())
	 {
	  $data[$i]=array('eventid'=>$rd["eventid"],'eventname'=>$rd["eventname"],'eventphoto'=>$rd["eventphoto"]);
	    
		 $flag=1;
		 $i++;
	 } 
	 if($flag==0)
	 {
		 
		 $data[0]=array("eventid"=>"not found");
		 $arr=array('messages'=>$data);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('messages'=>$data);
		 echo json_encode($arr);
		
	}
 
	 
	?>