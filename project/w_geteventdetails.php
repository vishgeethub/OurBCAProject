<?php
	$id=$_REQUEST["eventid"];
	
	include("dbconnection.php");
     $rs=$obj->query("select *from event_table n,area a,city c,state s,ngo_table v where n.areaid=a.areaid and a.cityid=c.cityid and c.stateid=s.stateid and n.NGOid=v.NGOid and eventid='$id'");
	 
	 
	 if($rd=$rs->fetch())
	 {
		 
		 $arr=array('eventid'=>$rd["eventid"],'eventname'=>$rd["eventname"],'NGOname'=>$rd["NGOname"],'eventdate'=>$rd["eventdate"],'eventtime'=>$rd["eventtime"],'venue'=>$rd["venue"],'eventphoto'=>$rd["eventphoto"],'description'=>$rd["description"],'areaid'=>$rd["areaid"],'areaname'=>$rd["areaname"],'cityid'=>$rd["cityid"],'cityname'=>$rd["cityname"],'stateid'=>$rd["stateid"],'statename'=>$rd["statename"],'contactno'=>$rd["contactno"]);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('eventid'=>'not found');
		echo json_encode($arr);
		
	}
	 
	 
	?>