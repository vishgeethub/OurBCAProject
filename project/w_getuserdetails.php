<?php
	$id=$_REQUEST["uid"];
	
	include("dbconnection.php");
     $rs=$obj->query("select *from user_table n,area a,city c,state s where n.areaid=a.areaid and a.cityid=c.cityid and c.stateid=s.stateid and uid='$id'");
	 
	 
	 if($rd=$rs->fetch())
	 {
		 
		 $arr=array('uid'=>$rd["uid"],'uname'=>$rd["uname"],'address'=>$rd["address"],'emailid'=>$rd["emailid"],'phone'=>$rd["phone"],'profilepic'=>$rd["profilepic"],'dob'=>$rd["dob"],'gender'=>$rd["gender"],'areaid'=>$rd["areaid"],'areaname'=>$rd["areaname"],'cityid'=>$rd["cityid"],'cityname'=>$rd["cityname"],'stateid'=>$rd["stateid"],'statename'=>$rd["statename"],'rdate'=>$rd["rdate"],'status'=>$rd["status"]);
	     echo json_encode($arr);
	 }
	 else
	 {
		 $arr=array('uid'=>'not found');
     echo json_encode($arr);
		
	}
	 
	 
	?>