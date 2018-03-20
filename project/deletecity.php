<?php
   $id=$_GET["x"];

   
   include("dbconnection.php");
   $obj->query("delete from city where cityid='$id'");
    header("Location:city.php");
?>