<?php
	
	//$catid=$_REQUEST["catid"];
	
	include("dbconnection.php");
     $rs=$obj->query("select *from event_table n,area a,city c,state s,ngo_table v where n.areaid=a.areaid and a.cityid=c.cityid and c.stateid=s.stateid and n.NGOid=v.NGOid");
	 $flag=0;
	 $i=0;
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('eventid'=>$rd["eventid"],'eventname'=>$rd["eventname"],'NGOname'=>$rd["NGOname"],'eventdate'=>$rd["eventdate"],'eventtime'=>$rd["eventtime"],'venue'=>$rd["venue"],'eventphoto'=>$rd["eventphoto"],'description'=>$rd["description"],'areaid'=>$rd["areaid"],'areaname'=>$rd["areaname"],'cityid'=>$rd["cityid"],'cityname'=>$rd["cityname"],'stateid'=>$rd["stateid"],'statename'=>$rd["statename"],'contactno'=>$rd["contactno"]);
	    
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