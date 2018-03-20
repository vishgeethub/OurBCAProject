<?php
   $id=$_POST["id"];
   $name=$_POST["t1"];
   $address=$_POST["t2"];
   $areaid=$_POST["c2"];
   $emailid=$_POST["t4"];
   $website=$_POST["t5"];
   $phno=$_POST["t6"];
   $f_name = $_FILES["t7"]["name"];
   $logo="image/".$f_name;
   move_uploaded_file($_FILES["t7"]["tmp_name"],$logo);
   $abtngo = $_POST["t8"];
   $loginid = $_POST["t9"];
   $password = $_POST["t10"];
   $rdate= date("Y-m-d");
   $status = 1;
   include("dbconnection.php");
   $obj->query("update ngo_table set NGOname='$name',address='$address',areaid='$areaid',emailid='$emailid',website='$website',phone='$phno',logo='$logo',description='$abtngo' where NGOid='$id'");
   header("Location:welcomengo.php");
?>