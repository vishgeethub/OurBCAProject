<?php
	$na=$_REQUEST["name"];
	$ad=$_REQUEST["address"];
	$aid=$_REQUEST["areaid"];
	$ph=$_REQUEST["phone"];
	$g=$_REQUEST["gender"];
	$dob=$_REQUEST["dob"];
	$e=$_REQUEST["emailid"];
	$l=$_REQUEST["loginid"];
	$p=$_REQUEST["password"];
        $rdate=date('Y-m-d');
        $status=1;	
	
	include("dbconnection.php");
         $path="image/".$_FILES["photo"]["name"];
         move_uploaded_file($_FILES["photo"]["tmp_name"],$path);
         $obj->query("insert into user_table(uname,address,areaid,phone,gender,dob,emailid,loginid,password,profilepic,rdate,status) values('$na','$ad','$aid','$ph','$g','$dob','$e','$l','$p','$path','$rdate','$status')");
	 
		$arr=array('messages'=>'Register Successfully');
		echo json_encode($arr);
	 
	?>