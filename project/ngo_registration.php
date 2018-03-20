<?php
	include("regheader.php");
?>
<style>
	.error{
		color:red;
		font-family:bookman old style;
	}
	.header{
		color:dark grey;
		font-family:bookman old style;
		font-size:50px;
		text-decoration:underline;
	}
	.table{
		color:dark grey;
		font-family:bookman old style;
		font-size:35px;
		text-decoration:underline;
	}
	.tbox{
		border:2px solid #b3b3b3;
		font-size:18px;
		background:#dddddd;
		width:200px;
		border-radius:15px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
	.tbl{
	border-collapse: separate;
    border-spacing: 2px 2px;
	border-color:dark grey;
	}

	</style>
<script>
function city()
{
    var sid = document.f1.t3.value;
	var xcity = new XMLHttpRequest();
	xcity.onreadystatechange = function()
        { 
		if(this.readyState == 4 && this.status == 200){		
            document.getElementById("d1").innerHTML = this.responseText;
			}
	    }    	
		xcity.open("GET","city_ajax.php?x="+sid,true);
		xcity.send();
        }
function area()
	{
          var cid = document.f1.c1.value;
	    var xcity = new XMLHttpRequest();
		xcity.onreadystatechange = function()
                {
         
		 if(this.readyState == 4 && this.status == 200){		
                  document.getElementById("d2").innerHTML = this.responseText;
        	}
	   }
            	
	  xcity.open("GET","area_ajax.php?x="+cid,true);
	  xcity.send();
		  
        }
	function checkchar(s,dname)
	{
		var l=s.length;
		var i,flag=true;
		for(i=0;i<l;i++)
		{
			var ch=s.charAt(i);
			if((ch>='a' && ch<='z') ||(ch>='A' && ch<='Z') || ch==" ")
			{
			}
			else
			{
                flag=false;
			}    
		}
		if(flag==false)
        {
			document.getElementById(dname).innerHTML="Invalid Character";
        }
        else
        {
            document.getElementById(dname).innerHTML="";
        }     
	}
	function checknumber(s,dname)
	{
		var l=s.length;
		var i,flag=true;
		for(i=0;i<l;i++)
		{
			var ch=s.charAt(i);
			if((ch>='0' && ch<='9'))
			{
			}
			else
			{
                flag=false;
			}    
		}
		if(flag==false)
        {
			document.getElementById(dname).innerHTML="Only digit's valid";
        }
        else
        {
            document.getElementById(dname).innerHTML="";
    
        }     
	}


	function validateEmail(email) 
	{
		var x = email;
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        return false;
		}
		else
		{
			return true;
		}
	}
	
  
	function check()
	{
		var na=document.f1.t1.value;
		var ad=document.f1.t2.value;
		var sid=document.f1.t3.value;
		var cid=document.f1.c1.value;
		var aid=document.f1.c2.value;
		var email=document.f1.t4.value;
		var phno=document.f1.t6.value;
		var uploadfile=document.f1.t7.value;
		var abtngo=document.f1.t8.value;
		var logid=document.f1.t9.value;
		var pswd=document.f1.t10.value;
		var cpswd=document.f1.t11.value;
		flag=true;
		if(na=="")
		{
			flag=false;
			document.getElementById("d11").innerHTML="Enter NGO Name";
		}
		else
		{
			document.getElementById("d11").innerHTML="";
		}
		if(ad=="")
		{
			flag=false;
			document.getElementById("d22").innerHTML="Enter NGO Address";
		}
		else
		{
			document.getElementById("d22").innerHTML="";
		}
		if(sid==0)
		{
			flag=false;
			document.getElementById("d33").innerHTML="Select State";
		}
		else
		{
			document.getElementById("d33").innerHTML="";
		}
		if(cid==0)
		{
			flag=false;
			document.getElementById("d44").innerHTML="Select City";
		}
		else
		{
			document.getElementById("d44").innerHTML="";
		}
		if(aid==0)
		{
			flag=false;
			document.getElementById("d55").innerHTML="Select Area";
		}
		else
		{
			document.getElementById("d55").innerHTML="";
		}
		if(email=="")
		{
			flag=false;
			document.getElementById("d6").innerHTML="Enter Emailid";
		}
		else
		{
			if(validateEmail(email))
			{
				document.getElementById("d6").innerHTML="";
			}
			else
			{
				document.getElementById("d6").innerHTML="Invalid Emailid"; 
			}
		}
		if(uploadfile=="")
		{
			flag=false;
			document.getElementById("d9").innerHTML="Enter image";
		}
		else
		{
			document.getElementById("d9").innerHTML="";
		}
		if(phno=="")
		{
			flag=false;
			document.getElementById("d8").innerHTML="Enter Contact No";
		}
		else
		{
			document.getElementById("d8").innerHTML="";
		}
		if(abtngo=="")
		{
			flag=false;
			document.getElementById("d10").innerHTML="Enter Details About NGO";
		}
		else
		{
			document.getElementById("d10").innerHTML="";
		}
		if(logid=="")
		{
			flag=false;
			document.getElementById("d111").innerHTML="Enter valid LoginID";
		}
		else
		{
			document.getElementById("d111").innerHTML="";
		}
		if(pswd=="")
		{
			flag=false;
			document.getElementById("d12").innerHTML="Enter valid password";
		}
		else
		{
			document.getElementById("d12").innerHTML="";
		}
		if(cpswd=="")
		{
			flag=false;
			document.getElementById("d13").innerHTML="For Confirmation Reenter Password";
		}
		else
		{
			if(pswd==cpswd)
			{
				document.getElementById("d13").innerHTML="";
			}
			else
			{
				flag=false;
				document.getElementById("d13").innerHTML="Password Not matched";
			}
		}
		return flag;               
	}
</script>

<?php
	include("dbconnection.php");
	$rs=$obj->query("select * from state");

?>
<center>
<form action="addngoregistration_details.php" onsubmit="return check();" method="post" name="f1" enctype="multipart/form-data">
<span class="header">NGO Registration</span><br><br>
<table>
	<tr>
		<td style="font-size:18px"><b>NGO Name:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" style="width:300px;height:38px" onKeyUp="checkchar(this.value,'d1');"  name="t1">
		<span id="d11" class="error"></span></td>
                
 	</tr>
   	<tr>
    		<td style="font-size:18px"><b>Address:</b><span style="color:red">*</span></td>
    		<td style="padding:5px"><textarea rows="3" class="tbox" style="width:300px;height:75px" cols="25" name="t2"></textarea>
			<span id="d22" class="error"></span></td>
   	</tr>
      	<tr>
    		<td style="font-size:18px"><b>State:</b><span style="color:red">*</span></td>
    		<td style="padding:5px">
			<select name="t3" style="width:300px;height:38px" class="tbox" onchange="city()">
    		      		<option value="0">---Select State---</option>
				<?php
					while($db=$rs->fetch())
					{
				?>
					<option value='<?php echo $db["stateid"]; ?>'><?php echo $db["statename"]; ?></option>
				<?php
					}
				?>  
        		</select>
                <span id="d33" class="error"></span>
      		</td>
   	</tr>
	<tr>
			<td style="font-size:18px"><b>City:</b><span style="color:red">*</span></td>
			<td style="padding:5px">
                       <div id="d1">
				<select name="c1" onchange="area()" class="tbox" style="width:300px;height:38px">
					<option value="0">---Select City---</option>
				</select>
                         
				<span id="d44" class="error"></span></div>
			</td>
	</tr>
	<tr>
			<td style="font-size:18px"><b>Area:</b><span style="color:red">*</span></td>
			<td style="padding:5px">
                        <div id="d2">
				<select name="c2" class="tbox" style="width:300px;height:38px">
					<option value="0">---Select Area---</option>
				</select>
                        		
				<span id="d55" class="error"></span></div>
			</td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Email ID:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t4" style="width:300px;height:38px">
        <span id="d6" class="error"></span></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Website:</b></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t5" style="width:300px;height:38px">
		</td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Phone No:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" onKeyUp="checknumber(this.value,'d8');" name="t6" style="width:300px;height:38px">
		<span id="d8" class="error"></span></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Logo:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input id="uploadfile" class="tbox"  style="width:300px" type="file" name="t7">
		<span id="d9" class="error"></span></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>About NGO:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><textarea rows="4" cols="30" class="tbox" name="t8"style="width:300px;height:75px"></textarea>
			<span id="d10" class="error"></span>
		</td>
	</tr>
	<tr>
    		<td style="font-size:18px"><b>Login ID:</b><span style="color:red">*</span></td>
    		<td style="padding:5px"><input type="text" class="tbox" name="t9" style="width:300px;height:38px">
			<span id="d111" class="error"></span></td>
   	</tr>
   	<tr>
    		<td style="font-size:18px"><b>Password:</b><span style="color:red">*</span></td>
    		<td style="padding:5px"><input type="password" class="tbox" name="t10" style="width:300px;height:38px">
			<span id="d12" class="error"></span></td>
   	</tr>
	<tr>
    		<td style="font-size:18px"><b>Confirm Password:</b><span style="color:red">*</span></td>
    		<td style="padding:5px"><input type="password" class="tbox" name="t11"style="width:300px;height:38px">
			<span id="d13" class="error"></span></td>
   	</tr>
	<tr>
<br>
<?php
 	if(isset($_GET["y"]))
	{
?>	
		<font color="red"><b>NGO name already exists.</b></font>
<?php
	}
	else if(isset($_GET["z"]))
	{
?>
		<font color="red"><b>NGO LoginID already exists.</b></font>
<?php
	}
?>
<br>
	</tr>
    	<tr>
    		<td>&nbsp;</td>
    		<td style="padding:5px"><input type="submit" class="tbox" value="Submit" style="width:150px;">
			<input type="reset" value="Cancel" class="tbox" style="width:150px;"></td>
   	</tr>
</table>
</form>
<?php
	include("visitorfooter.php");
?></center>