<?php
   $na=$_POST["t1"];
   include("dbconnection.php");
   $rs=$obj->query("select *from state where statename='$na'");
   if($rd=$rs->fetch())
   {
      header("Location:state.php?y=NotValid");
   }
   else
   {
      $obj->query("insert into state(statename)  values('$na')");
      header("Location:state.php");
  
     }		
?>