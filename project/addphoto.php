<?php 
   $f_name = $_FILES["t1"]["name"];
   $cover="image/".$f_name;
   move_uploaded_file($_FILES["t1"]["tmp_name"],$cover);
   $des=$_POST["t2"];
   $aid=$_POST["aid"];
   include("dbconnection.php");
   $obj->query("insert into photo_gallery(photo,description,album_id) values('$cover','$des','$aid')");
   header("Location:photo.php?x=$aid");
?>