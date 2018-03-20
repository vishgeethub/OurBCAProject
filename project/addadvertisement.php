<?php
	$path=$_FILES["i1"]["name"];
	$image="image/".$path;
	move_uploaded_file($_FILES["t1"] ["tmp_name"],$image);
	$naviurl=$_POST["t1"];
	$pdate=$_POST["t2"];
	$edate=$_POST["t3"];
	$advertiserid=$_POST["t4"];
	$amnt=$_POST["t5"];
	include("dbconnection.php");
	$obj->query("insert into advertisement_table(photo,navigateURL,posteddate,enddate,advertiserid,amount)  values('$image','$naviurl','$pdate','$edate','$advertiserid','$amnt')");
    	header("Location:advertisement.php");
?>