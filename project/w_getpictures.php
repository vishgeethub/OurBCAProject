<?php
	$aid=$_REQUEST["aid"];
	
	include("dbconnection.php");
     $rs=$obj->query("select *from photo_gallery where album_id='$aid'");
	 $flag=0;
	 $i=0;
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('gid'=>$rd["galleryid"],'photo'=>$rd["photo"],'description'=>$rd["description"] );
	    
		 $flag=1;
		 $i++;
	 }
	 
	 if($flag==0)
	 {
		 
		 $data[0]=array("gid"=>"not found");
		 $arr=array('messages'=>$data);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('messages'=>$data);
		 echo json_encode($arr);
		
	}
	 
	 
	?>