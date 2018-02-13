<?php
session_start();
if (isset($_SESSION['autentificado'])) {
include("Header_menu.php");
}else{
header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Empresas</h3>
            </div>
            <div class="row">
                <p>
                   <?php
                   if ($_SESSION['usuario'] == "turnosadmin"){ ?> 
			<a href="createEmpresas.php" class="btn btn-success">Crear</a>
                   <?php } ?>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Cuit</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Logo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'Database.php';
                   $pdo = Database::connect();
                   if ($_SESSION['usuario'] == "turnosadmin"){
		   $sql = "SELECT * FROM Empresas where RecDel='' ORDER BY Nombre ASC";
		   }else{
		   $sql = "SELECT * FROM Empresas where ID_Empresa='".$_SESSION['ID_Empresa']."'	   
   			   and RecDel='' ORDER BY Nombre ASC";
		   }		
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Cuit'] . '</td>';
                            echo '<td>'. $row['Nombre'] . '</td>';
                            echo '<td>'. $row['Descripcion'] . '</td>';
                            echo '<td>'. $row['Logo'] . '</td>';
                            echo '<td>';

if ($_SESSION['usuario'] == "turnosadmin") { 
echo '<span class="help-inline">
<form method="post" action="borrarEmpresa.php">
	<input name="ID_Empresa" type="hidden"  value='.$row['ID_Empresa'].'>	
	<button type="submit" class="btn btn-success">Borrar</button>
</form> 
</span>
<span class="help-inline">
<form method="post" action="modificarEmpresa.php">
	<input name="ID_Empresa" type="hidden"  value='.$row['ID_Empresa'].'>	
	<button type="submit" class="btn btn-success">Actualizar</button>
</form> 
</span>

<span class="help-inline">
<form method="post" action="indexSucursales.php">
	<input name="ID_Empresa" type="hidden"  value='.$row['ID_Empresa'].'>	
	<button type="submit" class="btn btn-success">Sucursales</button>
</form> 
</span>';}
echo '<span class="help-inline">
<form method="post" action="indexUsuarios.php">
	<input name="ID_Empresa" type="hidden"  value='.$row['ID_Empresa'].'>	
	<button type="submit" class="btn btn-success">Usuarios</button>
</form> 
</span>
<span class="help-inline">
<form method="post" action="indexClientes.php">
	<input name="ID_Empresa" type="hidden"  value='.$row['ID_Empresa'].'>	
	<button type="submit" class="btn btn-success">Clientes</button>
</form> 
</span>
<span class="help-inline">
<form method="post" action="indexRecursos.php">
	<input name="ID_EmpresaR" type="hidden"  value='.$row['ID_Empresa'].'>	
	<button type="submit" class="btn btn-success">Recursos</button>
</form> 
</span>
</td>';
echo '</tr>';

}
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
