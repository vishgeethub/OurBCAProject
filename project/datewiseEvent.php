<?php
	include("adminheader.php");
	include("dbconnection.php");
	$db=$obj->query("select * from category_table")
?>
<style>
.header{
		color:dark grey;
		font-family:bookman old style ;
		font-size:50px;		
		text-decoration:underline;
	}
	.tbox{
		border:2px solid #b3b3b3;
		background:#dddddd;
		width:200px;
		font-size:18px;	
		border-radius:15px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
</style>	
<script>
function data()
{
    var date1 = document.f1.date1.value;
    var date2 = document.f1.date2.value;

	var xcity = new XMLHttpRequest();
	xcity.onreadystatechange = function()
        { 
		if(this.readyState == 4 && this.status == 200){		
            document.getElementById("datadiv").innerHTML = this.responseText;
			}
	    }    	
		xcity.open("GET","DatewiseEvent_ajax.php?x="+date1+"&y="+date2,true);
		xcity.send();
        }

		</script>
<center>


<form  name="f1" method="post">
<center>
<span class="header">Datewise Event</span>

<br>
<br>
<table>
<tr>
		<td style="font-size:18px;"><b> To Date:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="date" class="tbox" name="date1" style="width:300px;height:38px">
		
 	</tr>
<tr>
		<td style="font-size:18px;"><b> From Date:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="date" class="tbox" name="date2" style="width:300px;height:38px">
		
 	</tr>

	<tr>
			<td>&nbsp;</td>
		<td style="padding:5px" align="center"><div id="d5"><input type="button" class="tbox" onclick="data();" value="Submit" name="b1" style="width:150px;font-size:18px"></div></td>
</tr>

</table>
</center>
</form>

<br>
<div id="datadiv"></div>

<br>
<br>
<br>
<br>

<?php
	include("adminfooter.php");
?></center>