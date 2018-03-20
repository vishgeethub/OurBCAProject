<?php

	include("dbconnection.php");
     $rs=$obj->query("select *from ngo_table n,area a,city c,state s where n.areaid=a.areaid and a.cityid=c.cityid and c.stateid=s.stateid ");
	 
	 $i=0;
	 $flag=0;
	 while($rd=$rs->fetch())
	 {
		 $data[$i]=array('ngoid'=>$rd["NGOid"],'name'=>$rd["NGOname"],'address'=>$rd["address"],'emailid'=>$rd["emailid"],'website'=>$rd["website"],'phone'=>$rd["phone"],'logo'=>$rd["logo"],'description'=>$rd["description"],'areaid'=>$rd["areaid"],'areaname'=>$rd["areaname"],'cityid'=>$rd["cityid"],'cityname'=>$rd["cityname"],'stateid'=>$rd["stateid"],'statename'=>$rd["statename"]);
		 $flag=1;
	     $i++;	 
	 }
	 
	 
	 if($flag==0)
	 {
		 $data[0]=array("ngoid"=>"not found"); 
	     $arr=array('messages'=>$data);
          echo json_encode($arr);
	 }
	 else
	 {
	
          $arr=array('messages'=>$data);
          echo json_encode($arr);
		
	 }
	 
	?>