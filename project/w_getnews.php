<?php

	
	include("dbconnection.php");
     $rs=$obj->query("select n.newsid,n.description,n.short_desc,n.NGOid ,no.NGOname,no.logo,n.photo,n.newsdate from news_table n,ngo_table no where n.NGOid=no.NGOid ORDER BY n.newsdate DESC");
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