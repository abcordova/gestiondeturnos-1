<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es-ar"><head>
    <meta charset="utf-8">
    <link   href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    

<title>Gestion de Turnos</title><meta content="CasaCentral" name="author">
</script> 
<style ="direction: ltr;"></style><style ="text-align: left;">
body {
	background-color: #FFFFFF;
}
</style></head>

<table width=100% border="0">
  <tr>
    <td>  <div align="left"><img src="images/Aldamada_logo.png" width="121" height="35" class="img-responsive"><br>
    </div></td>
    <td width="51%" nowrap><?php
	if (isset($_SESSION['autentificado'])) {  ?>
      <center>
      </center>
	
</td>
    <td width="24%" nowrap><div align="right">
      <p align="left"><b>Usuario: <?php echo $_SESSION["usuario"]?></b></p>
      <p align="left"><b>Empresa: <?php echo $_SESSION["Empresa_Nombre"]?></b></p>
      <p align="left"><a href="logout.php">Salir</a></p>
    </div></td>
  </tr>     <?php } ?>
</table>
</form> 
<div align="right"><a href="logout.php"></a></div>
 <hr style="background-color: rgb(51, 0, 51); height: 3px; width: 100%;" noshade="noshade">       
</body></html>
