<?php session_start();
   $l=$_GET["l"];
   $p=$_GET["p"];

   
   include("dbconnection.php");
   $rs=$obj->query("select *from admin_table where loginid='$l' and password='$p'");
   if($rd=$rs->fetch())
   {
    echo "1";
   }
   else
   {
         $rs1=$obj->query("select *from ngo_table where loginid='$l' and password='$p'");
          if($rd1=$rs1->fetch())
           {
               $_SESSION["nid"]=$rd1["NGOid"];
               echo "2";
            }
            else
           {    
           echo "0";
            }
   }
?>