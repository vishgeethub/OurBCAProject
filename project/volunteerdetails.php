
<?php
	include("dbconnection.php");
?>
<style>
.header{
		color:dark grey;
		font-family:bookman old style;
		font-size:50px;
		text-decoration:underline;
		}
</style>

<script>
	function volunteer()
	{
          var sid = document.f1.t3.value;
	    var xcity = new XMLHttpRequest();
		xcity.onreadystatechange = function()
                {
         
		 if(this.readyState == 4 && this.status == 200){		
                  document.getElementById("d1").innerHTML = this.responseText;
        	}
	   }
            	
	  xcity.open("GET","volunteer_ajax.php?x="+sid,true);
	  xcity.send();
	  
        }
</script>
<br>
<br>
<center><span class="header">Volunteer Details</span></center><br> <br>

<?php session_start();
	include("ngoheader.php");
	$nid=$_SESSION["nid"];
	include("dbconnection.php");
	$rs=$obj->query("select * from event_table where NGOid='$nid' ");
?>
<form name="f1">
<tr>
    		<center><td><b>Select Event:</b><span style="color:red">*</span></td>
    		<td style="padding:5px">
			<select name="t3" onchange="volunteer()">
    		      		<option value="0">---Select Event---</option>
				<?php
					while($db=$rs->fetch())
					{
				?>
					<option value='<?php echo $db["eventid"]; ?>'><?php echo $db["eventname"]; ?></option>
				<?php
					}
				?>  
        		</select>
				<span id="d1" style="color:red"></span></div>
      		</td></center>
   	</tr>
</form>
<br>
<br>


		<div id="d1">	
		</div>


<?php
	include("ngofooter.php");
?>