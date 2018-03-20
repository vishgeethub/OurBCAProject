<?php
	$eid=$_REQUEST["eid"];
	
	include("dbconnection.php");
     $rs=$obj->query("select *from album_table where eventid='$eid'");
	 $flag=0;
	 $i=0;
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('aid'=>$rd["album_id"],'album_name'=>$rd["album_name"],'album_pic'=>$rd["coverpage"] );
	    
		 $flag=1;
		 $i++;
	 }
	 
	 if($flag==0)
	 {
		 
		 $data[0]=array("aid"=>"not found");
		 $arr=array('messages'=>$data);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('messages'=>$data);
		 echo json_encode($arr);
		
	}
	 
	 
	?>