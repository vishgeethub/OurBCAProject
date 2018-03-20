<?php

	$id=$_REQUEST["newsid"];
	
	include("dbconnection.php");
     $rs=$obj->query("select *from news_table n,ngo_table no where n.NGOid=no.NGOid and n.newsid='$id' ");
	 $flag=0;
	 $i=0;
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('newsid'=>$rd["newsid"],'short_desc'=>$rd["short_desc"],'description'=>$rd["description"],'ngoid'=>$rd["NGOid"],'ngoname'=>$rd["NGOname"],'logo'=>$rd["logo"],'photo'=>$rd["photo"],'newsdate'=>$rd["newsdate"]);
	    
		 $flag=1;
		 $i++;
	 }
	 
	 if($flag==0)
	 {
		 
		 $data[0]=array("newsid"=>"not found");
		 $arr=array('messages'=>$data);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('messages'=>$data);
		 echo json_encode($arr);
		
	}
	 
	 
	?>