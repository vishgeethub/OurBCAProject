<?php
   $id=$_GET["x"];
   
   include("dbconnection.php");
   $obj->query("delete from album_table where album_id='$id'");
    header("Location:album.php");
?>