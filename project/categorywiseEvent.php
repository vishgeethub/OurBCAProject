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
		border-radius:15px;
		font-size:18px;	
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
</style>
<script>
function data()
{
    var catid = document.f1.c1.value;
	var xcity = new XMLHttpRequest();
	xcity.onreadystatechange = function()
        { 
		if(this.readyState == 4 && this.status == 200){		
            document.getElementById("datadiv").innerHTML = this.responseText;
			}
	    }    	
		xcity.open("GET","categorywiseEvent_ajax.php?x="+catid,true);
		xcity.send();
        }

		</script>
<center>


<form  name="f1" method="post">
<center>
<span class="header">Categorywise Event</span>

<br>
<br>
<table>
<tr>
    		<td style="font-size:18px;"><b>Category:</b></td>
    		<td style="padding:5px">
			<select name="c1" class="tbox" style="width:300px;height:38px" >
    		      		<option value="0">---Select Category---</option>
				<?php
					while($rs=$db->fetch())
					{
				?>
					<option value='<?php echo $rs["cat_id"]; ?>'><?php echo $rs["cat_name"]; ?></option>
				<?php
					}
				?>  
        		</select>
              
      		</td>
   	</tr>
	<tr>
		<td>&nbsp;</td>
		<td style="padding:5px" align="center"><div id="d5"><input type="button"  onclick="data();" value="Submit" name="b1" class="tbox" style="width:150px;font-size:18px;"></div></td>
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
<br>
<br>

<?php
	include("adminfooter.php");
?></center>