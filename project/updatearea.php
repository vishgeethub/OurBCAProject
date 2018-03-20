<?php

	$id=$_POST["id"];
	$na=$_POST["t1"];
	$pcode=$_POST["t2"];
        $cid=$_POST["t3"];
include("dbconnection.php");
$obj->query("update area set areaname='$na',pincode='$pcode',cityid='$cid' where areaid='$id'");
header("Location:area.php");
?>

















