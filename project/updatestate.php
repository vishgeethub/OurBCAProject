<?php

	$id=$_POST["id"];
	$na=$_POST["t1"];
include("dbconnection.php");
$obj->query("update state set statename='$na' where stateid='$id' ");
header("Location:state.php");
?>

















