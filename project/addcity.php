<?php
   $na=$_POST["t1"];
   $sid=$_POST["t2"];
   include("dbconnection.php");
   $rs=$obj->query("select *from city where cityname='$na'");
   if($rd=$rs->fetch())
   {
      header("Location:city.php?y=NotValid");
   }
   else
   {
   $obj->query("insert into city(cityname,stateid) values('$na','$sid')");
    header("Location:city.php");
   }
?>