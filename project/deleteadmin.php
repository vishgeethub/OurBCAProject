<?php
   $id=$_GET["x"];
   
   include("dbconnection.php");
   $obj->query("delete from admin_table where aid='$id'");
    header("Location:login.php");
?>