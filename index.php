<html>
      <head>
<?php
include("Header_menu.php");
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
var p,i,x; if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
if (val) { nm=val.name; if ((val=val.value)!="") {
if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe contener una dirección de email válida.\n';
} else if (test!='R') { num = parseFloat(val);
if (isNaN(val)) errors+='- '+nm+' debe contener un número.\n';
if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
min=test.substring(8,p); max=test.substring(p+1);
if (num<min || max<num) errors+='- '+nm+' debe ser entre '+min+' y '+max+'.\n';
} } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es obligatorio.\n'; }
} if (errors) alert('Error(es) en el formulario:\n'+errors);
document.MM_returnValue = (errors == '');
}
//-->
</script>

      </head>
<body>
<?php
if ($_GET['login'] !='')
{   ?>      
	<script type="text/javascript">
                alert('Usuario inexistente/bloqueado o password incorrecto');
            </script>
<?php
}  ?>  

<FORM name="Login" method="post" ACTION="login.php" class="form-horizontal">
<center>
 <TABLE BORDER=0 CELLPADDING=4>
        <TR> <TD align = left><b>Usuario:</b></TD>      <TD align = left><INPUT NAME=username></TD> </TR>
        <TR> <TD align = left><b>Password:</b></TD>      <TD align = left><INPUT TYPE=PASSWORD NAME=password></TD> </TR>
 </table>
       <br>
       <INPUT TYPE=SUBMIT onClick="MM_validateForm('username','','R','password','','R');return document.MM_returnValue" VALUE="Acceder" class="btn btn-success">
</center>
</FORM>



</body>
</html>
