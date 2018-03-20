<?php
	
	$catid=$_REQUEST["catid"];
	if($catid=="5")
	{

		include("dbconnection.php");
    		$rs=$obj->query("select n.eventid,n.eventname,v.NGOname,n.eventdate,n.eventtime,n.venue,n.eventphoto,n.description,a.areaname,c.cityname,c.cityid,s.statename,n.contactno,cat.cat_name,s.stateid,a.areaid from event_table n,area a,city c,state s,ngo_table v,category_table cat where n.areaid=a.areaid and a.cityid=c.cityid and c.stateid=s.stateid and n.NGOid=v.NGOid and n.cat_id=cat.cat_id ORDER BY n.eventdate DESC");
 		$flag=0;
	 	$i=0;
	}
	else
	{
	include("dbconnection.php");
	
     $rs=$obj->query("select n.eventid,n.eventname,v.NGOname,n.eventdate,n.eventtime,n.venue,n.eventphoto,n.description,a.areaname,c.cityname,s.statename,n.contactno,cat.cat_name from event_table n,area a,city c,state s,ngo_table v,category_table cat where n.areaid=a.areaid and a.cityid=c.cityid and c.stateid=s.stateid and n.NGOid=v.NGOid and n.cat_id=cat.cat_id and n.cat_id='$catid' ORDER BY n.eventdate DESC");
	 $flag=0;
	 $i=0;
}
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('eventid'=>$rd["eventid"],'eventname'=>$rd["eventname"],'NGOname'=>$rd["NGOname"],'eventdate'=>$rd["eventdate"],'eventtime'=>$rd["eventtime"],'venue'=>$rd["venue"],'eventphoto'=>$rd["eventphoto"],'description'=>$rd["description"],'areaid'=>$rd["areaid"],'areaname'=>$rd["areaname"],'cityid'=>$rd["cityid"],'cityname'=>$rd["cityname"],'stateid'=>$rd["stateid"],'statename'=>$rd["statename"],'contactno'=>$rd["contactno"],'catname'=>$rd["cat_name"],'ngoname'=>$rd["NGOname"]);
	    
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