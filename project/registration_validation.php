<style>
    div{
        color:red;
     }
</style>
<script>
   function checkdata()
   {
      var flag=true;
      var na=document.f1.t1.value;
      var ad=document.f1.t2.value;
      var ct=document.f1.t3.value;
      var ph=document.f1.t4.value;
      var l=document.f1.t5.value;
      var p=document.f1.t6.value;
      var rp=document.f1.t7.value;



      if(na=="")
       {
          //alert("Enter the name");
          document.getElementById("d1").innerHTML="Enter the Name";
         flag=false;
       }
       else
       {
          document.getElementById("d1").innerHTML="";
           
       }

      if(ad=="")
       {
          //alert("Enter the name");
          document.getElementById("d2").innerHTML="Enter the Address";
         flag=false;
       }
       else
        {
        document.getElementById("d2").innerHTML="";
       }


      if(ct=="0")
       {
          //alert("Enter the name");
          document.getElementById("d3").innerHTML="Enter the city";
         flag=false;
       }
       else
        {
        document.getElementById("d3").innerHTML="";
       }


      if(ph=="")
       {
          //alert("Enter the name");
          document.getElementById("d4").innerHTML="Enter the Phone No.";
         flag=false;
       }
       else
        {
             if(ph.lenght!=10)
               {
                   document.getElementById("d4").innerHTML="Invalid phone no.";
            
               }
               else
                {
             document.getElementById("d4").innerHTML="";
              }
       }


      if(l=="")
       {
          //alert("Enter the name");
          document.getElementById("d5").innerHTML="Enter the loginid";
         flag=false;
       }
       else
        {
        document.getElementById("d5").innerHTML="";
       }


      if(p=="")
       {
          //alert("Enter the name");
          document.getElementById("d6").innerHTML="Enter the Password";
         flag=false;
       }
       else
        {
             if(p.length>4)
             {
              document.getElementById("d6").innerHTML="";
            }
             else
              {
                   document.getElementById("d6").innerHTML="Password must be greater than 4 character";
               }
       }

       
      if(p!=rp)
       {
          //alert("Enter the name");
          document.getElementById("d7").innerHTML="Password not match";
         flag=false;
       }
       else
        {
        document.getElementById("d7").innerHTML="";
       }


     return flag;
   }
</script>
<form action="adduser.php" onsubmit="return checkdata();" name="f1" method="post" >
   <table>
    <tr>
        <td>Name</td>
        <td><input type="text" name="t1"><div id="d1"></div></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><textarea name="t2" rows="3" cols="20"></textarea><div id="d2"></div></td>
    </tr>
    <tr>
        <td>City</td>
        <td><select name="t3">
              <option value="0">--Select City--</option>
              <option value="Ahmedabad">Ahmedabad</option>
              <option value="Bombay">Bombay</option>
             </select>
              <div id="d3">
              </div>
         </td>
    </tr>
       <tr>
        <td>Phone</td>
        <td><input type="text" name="t4"><div id="d4"></div></td>
    </tr>
       <tr>
        <td>Loginid</td>
        <td><input type="text" name="t5"><div id="d5"></div></td>
    </tr>
       <tr>
        <td>Password</td>
        <td><input type="password" name="t6"><div id="d6"></div></td>
    </tr>
 <tr>
        <td>Retype Password</td>
        <td><input type="password" name="t7"><div id="d7"></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Submit"></td>
     </tr>
   </table>
</form>
  
