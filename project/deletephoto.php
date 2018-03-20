<?php
   $id=$_GET["x"];
   $aid=$_GET["aid"];
   include("dbconnection.php");
   $obj->query("delete from photo_gallery where galleryid='$id'");
    header("Location:photo.php?x=$aid");
?>