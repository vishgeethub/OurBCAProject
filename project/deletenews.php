<?php
   	$id=$_GET["x"];
   	include("dbconnection.php");
	$obj->query("delete from news_table where newsid='$id'");
    	header("Location:news.php");
?>