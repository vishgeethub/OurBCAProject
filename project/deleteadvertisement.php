<?php
   	$id=$_GET["x"];
   	include("dbconnection.php");
	$obj->query("delete from advertisement_table where advertisementid='$id'");
    	header("Location:advertisement.php");
?>