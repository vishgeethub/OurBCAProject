<?php session_start();
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
   $obj->query("insert into event_table(eventname,ngoid,description,eventdate,eventtime,venue,areaid,eventphoto,contactno,cat_id) values('$name','$ngoid','$description','$date','$time','$venue','$area','$logo','$phno','$catid')");
   header("Location:event.php");
?>