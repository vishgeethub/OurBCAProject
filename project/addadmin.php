<?php
   $aname=$_POST["t1"];
   $loginid = $_POST["t2"];
   $password = $_POST["t3"];
   $emailid=$_POST["t4"];
   include("dbconnection.php");
   $obj->query("insert into admin_table(aname,loginid,password,emailid) values('$aname','$loginid','$password','$emailid'");
  
?>