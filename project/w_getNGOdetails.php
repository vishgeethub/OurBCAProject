<?php
	//$id=$_REQUEST["ngoid"];
	
	include("dbconnection.php");
     $rs=$obj->query("select *from ngo_table n,area a,city c,state s where n.areaid=a.areaid and a.cityid=c.cityid and c.stateid=s.stateid ");
	 
	 
	 if($rd=$rs->fetch())
	 {
		 
		 $arr=array('ngoid'=>$rd["NGOid"],'name'=>$rd["NGOname"],'address'=>$rd["address"],'emailid'=>$rd["emailid"],'website'=>$rd["website"],'phone'=>$rd["phone"],'logo'=>$rd["logo"],'description'=>$rd["description"],'areaid'=>$rd["areaid"],'areaname'=>$rd["areaname"],'cityid'=>$rd["cityid"],'cityname'=>$rd["cityname"],'stateid'=>$rd["stateid"],'statename'=>$rd["statename"]);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('ngoid'=>'not found');
     		echo json_encode($arr);
		
	}
	 
	 
	?>