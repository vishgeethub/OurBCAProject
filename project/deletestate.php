<?php
   $id=$_GET["x"];

   
   include("dbconnection.php");
   $obj->query("delete from state where stateid='$id'");
    header("Location:state.php");
?>