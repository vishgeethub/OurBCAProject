<?php
	$na=$_POST["t1"];
	$path=$_FILES["i1"]["name"];
	$image="image/".$path;
	move_uploaded_file($_FILES["i1"] ["tmp_name"],$image);
	include("dbconnection.php");
	$obj->query("insert into news_table(description,photo)  values('$na','$image')");
    	header("Location:news.php");
?>