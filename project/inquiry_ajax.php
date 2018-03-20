<?php
		include("adminheader.php");
	include("dbconnection.php");
	$rsb=$obj->query("select * from inquiry_table");
?>
<style>
.table{
		color:dark grey;
		font-family:bookman old style;
		font-size:35px;
		text-decoration:underline;	
	}
	.tbl{
	border-collapse: separate;
    border-spacing: 2px 2px;
	border-color:dark grey;
	}

	</style>
<center>

   <br>
<span class="table"> Inquiry Details</span><br><br>
<br>
  
<br>
<table class="tbl"border=2>
	<tr>
		<td style="padding:10px"><b><u>Name</b></u></td>
		<td style="padding:10px"><b><u>E-mail</b></u></td>
		<td style="padding:10px"><b><u>Message</b></u></td>
	</tr>
	<?php	
			while($rsf=$rsb->fetch())
			{
		?>
			<tr>
			<td style="padding:10px"><?php echo $rsf["inqname"]; ?></td>
			<td style="padding:10px"><?php echo $rsf["emailid"]; ?></td>
			<td style="padding:10px"><?php echo $rsf["msg"]; ?></td>
			</tr>
             <?php
			}
			 ?>
			</table>
			<br>
			<form action="tcpdf/examples/inquiry.php" method="post">
			<input type="submit" class="tbox" value="Export To PDF">	
</form>			
<?php
	include("adminfooter.php");
?></center>