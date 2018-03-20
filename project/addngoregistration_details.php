<?php
   $name=$_POST["t1"];
   $address=$_POST["t2"];
   $areaid=$_POST["c2"];
   $emailid=$_POST["t4"];
   $website=$_POST["t5"];
   $phno=$_POST["t6"];
   $f_name = $_FILES["t7"]["name"];
   $logo="image/".$f_name;
   move_uploaded_file($_FILES["t7"]["tmp_name"],$logo);
   $abtngo = $_POST["t8"];
   $loginid = $_POST["t9"];
   $password = $_POST["t10"];
   $rdate= date("Y-m-d");
   $status = 1;
   include("dbconnection.php");
   $rs=$obj->query("select *from ngo_table where NGOname='$name'");
   $ab=$obj->query("select *from ngo_table where loginid='$loginid'");
if($rd=$rs->fetch())
   {
      header("Location:ngo_registration.php?y=NotValid");
   }
else if($bc=$ab->fetch())
   {
      header("Location:ngo_registration.php?z=NotValid");
   }
   else
   {
   $obj->query("insert into ngo_table(NGOname,address,areaid,emailid,website,phone,logo,description,loginid,password,rdate,status) values('$name','$address','$areaid','$emailid','$website','$phno','$logo','$abtngo','$loginid','$password','$rdate','$status')");
   header("Location:login.php");
}
?>