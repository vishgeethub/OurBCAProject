<?php
	$name= $_POST["t1"];
	$cname= $_POST["t2"];
	$cnum= $_POST["t3"];
	$eid= $_POST["t4"];
	$date= date("Y-m-d");
	include("dbconnection.php");
	$rs=$obj->query("select *from advertiser_table where companyname='$cname'");
	if($rd=$rs->fetch())
	{
		header("Location:advertiser.php?y=NotValid");
	}
	else
	{

	$obj->query("insert into advertiser_table(name,companyname,contactno,emailid,regdate) values('$name','$cname','$cnum','$eid','$date')");
header("Location:advertiser.php");
	}
?>