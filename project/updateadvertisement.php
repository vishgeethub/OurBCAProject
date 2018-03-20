<?php
	$id=$_POST["id"];
	$path=$_FILES["i1"]["name"];
	$image="image/".$path;
	move_uploaded_file($_FILES["i1"] ["tmp_name"],$image);
	$naviurl=$_POST["t1"];
	$pdate=$_POST["t2"];
	$edate=$_POST["t3"];
	$advertiserid=$_POST["t4"];
	$amnt=$_POST["t5"];
	include("dbconnection.php");
	$obj->query("update advertisement_table set photo='$image',navigateURL='$naviurl',posteddate='$pdate',enddate='$edate',advertiserid='$advertiserid',amount='$amnt' where advertisementid='$id'");
    	header("Location:advertisement.php");
?>