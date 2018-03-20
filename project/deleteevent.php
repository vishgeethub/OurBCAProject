<?php
   $id=$_GET["x"];
   
   include("dbconnection.php");
   $obj->query("delete from event_table where eventid='$id'");
    header("Location:event.php");
?>