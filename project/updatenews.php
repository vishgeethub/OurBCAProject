<?php
   $id=$_POST["id"];
   $na=$_POST["t1"];
    $path=$_FILES["i1"]["name"];
    $image="image/".$path;
    move_uploaded_file($_FILES["i1"] ["tmp_name"],$image);

   
   include("dbconnection.php");
   $obj->query("update news_table set description='$na',photo='$image' where newsid='$id'");
    header("Location:news.php");
?>