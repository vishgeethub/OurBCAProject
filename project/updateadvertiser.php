<?php
   	$id=$_POST["id"];
   	$name=$_POST["t1"];
	$cname=$_POST["t2"];
	$cnum=$_POST["t3"];
	$emailid=$_POST["t4"];
   
   	include("dbconnection.php");
   	$obj->query("update advertiser_table set name='$name',companyname='$cname',contactno='$cnum',emailid='$emailid' where advertiserid='$id'");
    	header("Location:advertiser.php");
?>