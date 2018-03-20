<?php
   	$id=$_GET["x"];
   	include("dbconnection.php");
	$obj->query("delete from advertiser_table where advertiserid='$id'");
    	header("Location:advertiser.php");
?>