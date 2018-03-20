<?php
	include("adminheader.php");
	include("dbconnection.php");
	$db=$obj->query("select * from state")
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
    var sid = document.f1.c1.value;
	var xcity = new XMLHttpRequest();
	xcity.onreadystatechange = function()
        { 
		if(this.readyState == 4 && this.status == 200){		
            document.getElementById("datadiv").innerHTML = this.responseText;
			}
	    }    	
		xcity.open("GET","statewiseNGO_ajax.php?x="+sid,true);
		xcity.send();
        }
</script>
<center>


<form  name="f1" method="post">
<center>
<span class="header">Statewise NGO</span>
<br>
<br>
<table>
<tr>
    		<td><b>State:</b></td>
    		<td style="padding:5px">
			<select name="c1" class="tbox" style="width:300px;height:38px" onchange="city()">
    		      		<option value="0">---Select State---</option>
				<?php
					while($rs=$db->fetch())
					{
				?>
					<option value='<?php echo $rs["stateid"]; ?>'><?php echo $rs["statename"]; ?></option>
				<?php
					}
				?>  
        		</select>
                <span id="d33" class="error"></span>
      		</td>
   	</tr>
	
	<tr>
	<td>&nbsp;</td>
		<td style="padding:5px" align="center"><div id="d5"><input type="button" class="tbox" onclick="data();" value="Submit" name="b1" style="width:150px;"></div></td>
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