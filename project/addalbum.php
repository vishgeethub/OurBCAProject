<?php 
  
   $f_name = $_FILES["t6"]["name"];
   $cover="image/".$f_name;
   move_uploaded_file($_FILES["t6"]["tmp_name"],$cover);
 $name=$_POST["t1"];
   $eventid=$_POST["event"];
   include("dbconnection.php");
	$rs=$obj->query("select *from album_table where album_name='$name'");
 if($rd=$rs->fetch())
   {
      header("Location:album.php?y=NotValid");
   }
   else
{
   $obj->query("insert into album_table(album_name,coverpage,eventid) values('$name','$cover','$eventid')");
   header("Location:album.php");
}
?>