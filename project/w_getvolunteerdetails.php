<?php
	$uid=$_REQUEST["uid"];

	
	include("dbconnection.php");
     $rs=$obj->query("select *from volunteer_table v,event_table e where e.eventid=v.eventid and  uid='$uid'");
	 $flag=0;
	 $i=0;
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('volunteerid'=>$rd["volunteerid"],'eventid'=>$rd["eventid"],'eventname'=>$rd["eventname"],'eventdate'=>$rd["eventdate"],'eventtime'=>$rd["eventtime"],'eventphoto'=>$rd["eventphoto"]);
	    
		 $flag=1;
		 $i++;
	 }
	 
	 if($flag==0)
	 {
		 
		 $data[0]=array("volunteerid"=>"not found");
		 $arr=array('messages'=>$data);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('messages'=>$data);
		 echo json_encode($arr);
		
	}
	 
	 
	?>