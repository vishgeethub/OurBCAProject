<?php
   $id=$_GET["x"];

   
   include("dbconnection.php");
   $obj->query("delete from area where areaid='$id'");
    header("Location:area.php");
?>