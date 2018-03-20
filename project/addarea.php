<?php
   $na=$_POST["t1"];
   $pcode=$_POST["t2"];
   $cid=$_POST["t3"];
   include("dbconnection.php");
    $rs=$obj->query("select *from area where areaname='$na'");
   if($rd=$rs->fetch())
   {
      header("Location:area.php?y=NotValid");
   }
   else
{
   $obj->query("insert into area(areaname,pincode,cityid) values('$na','$pcode','$cid')");
    header("Location:area.php");
}
?>