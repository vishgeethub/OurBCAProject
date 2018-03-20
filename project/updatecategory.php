<?php

	$id=$_POST["id"];
	$na=$_POST["t1"];
include("dbconnection.php");
$obj->query("update category_table set cat_name='$na' where cat_id='$id' ");
header("Location:category.php");
?>

















