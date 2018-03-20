<?php
	$uid=$_REQUEST["uid"];

	
	include("dbconnection.php");
     $rs=$obj->query("select c.charityid,u.uname,u.loginid,n.NGOname,n.website,c.amount,c.purpose,c.charitydate,n.phone from charity_table c,user_table u,ngo_table n where u.uid=c.uid and n.NGOid=c.NGOid and c.uid='$uid' ORDER BY c.charitydate DESC");
	 $flag=0;
	 $i=0;
	 while($rd=$rs->fetch())
	 {
	
	  $data[$i]=array('charityid'=>$rd["charityid"],'uname'=>$rd["uname"],'loginid'=>$rd["loginid"],'NGOname'=>$rd["NGOname"],'website'=>$rd["website"],'amount'=>$rd["amount"],'purpose'=>$rd["purpose"],'charitydate'=>$rd["charitydate"],'phone'=>$rd["phone"]);
	    
		 $flag=1;
		 $i++;
	 }
	 
	 if($flag==0)
	 {
		 
		 $data[0]=array("charityid"=>"not found");
		 $arr=array('messages'=>$data);
	     echo json_encode($arr);
	 }
	 else
	 {
		$arr=array('messages'=>$data);
		 echo json_encode($arr);
		
	}
	 
	 
	?>