<?php session_start();
   $id=$_POST["id"];
   $name=$_POST["t1"];
   $ngoid=$_SESSION["nid"];
   $description=$_POST["description"];
   $date= $_POST["date"];
   $time=$_POST["time"];
   $venue=$_POST["venue"];
   $area=$_POST["c2"];
   $f_name = $_FILES["t6"]["name"];
   $logo="image/".$f_name;
   move_uploaded_file($_FILES["t7"]["tmp_name"],$logo);
   $phno=$_POST["t7"];
   $catid=$_POST["t8"];
   include("dbconnection.php");
   $obj->query("update event_table set eventname='$name',ngoid='$ngoid',description='$description',eventdate='$date',eventtime='$time',venue='$venue',areaid='$area',eventphoto='$logo',contactno='$phno',cat_id='$catid' where eventid='$id' ");
   header("Location:event.php");
?>