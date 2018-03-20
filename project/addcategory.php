<?php
   $na=$_POST["t1"];
   include("dbconnection.php");
   $rs=$obj->query("select *from category_table where cat_name='$na'");
   if($rd=$rs->fetch())
   {
      header("Location:category.php?y=NotValid");
   }
   else
   {
   $obj->query("insert into category_table(cat_name)  values('$na')");
    header("Location:category.php");
   }
?>