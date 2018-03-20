<?php

	$id=$_POST["id"];
	$na=$_POST["t1"];
        $sid=$_POST["t2"];
include("dbconnection.php");
$obj->query("update city set cityname='$na',stateid='$sid' where cityid='$id'");
header("Location:city.php");
?>

















