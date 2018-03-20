<?php
   $id=$_GET["x"];
   
   include("dbconnection.php");
   $obj->query("delete from category_table where cat_id='$id'");
    header("Location:category.php");
?>