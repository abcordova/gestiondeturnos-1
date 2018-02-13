<?php
session_start();
if (isset($_SESSION['autentificado'])) {
include("Header_menu.php");
}else{
header("Location: index.php");
}
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $ID_Empresa = null;
         
        // keep track post values
        //$ID_Empresa = $_POST['ID_Empresa'];
        $_SESSION['ID_Empresa'] = $_POST['ID_Empresa'];
       
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
                <h3>Cuentas de Usuario</h3>
            </div>
            <div class="row">
                <p>
                  <form method="post" action="createUsuarios.php">
			<input name="IDEmpresa" type="hidden"  value="<?php echo $_SESSION['ID_Empresa'];?>">	
			<button type="submit" class="btn btn-success">Crear</button>
                        <a class="btn" href="indexTiposDeUsuario.php">Tipos</a>
                        <a class="btn" href="indexEmpresas.php">Volver</a>
	          </form> 

                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Estado</th>
                      <th>Tipo de Usuario</th>                      
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'Database.php';
                   $pdo = Database::connect();
                   $sql = "SELECT * FROM Usuario_Empresa_Sucursal UES
			   Left join Usuarios U on U.ID_Usuario=UES.ID_Usuario
			   Left join Tipos_Usuario TU on U.ID_Tipo_Usuario=TU.ID_Tipo_Usuario 	
			   where UES.ID_Empresa='".$_SESSION['ID_Empresa']."' 
			   and UES.RecDel='' and U.RecDel='' and TU.RecDel=''
			   group by U.ID_Usuario, Nombre, Username, Password, Estado, U.ID_Tipo_Usuario, UES.ID_Empresa,Descripcion	
			   ORDER BY Nombre ASC";
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Nombre'] . '</td>';
                            echo '<td>'. $row['Username'] . '</td>';
                            echo '<td>'. $row['Password'] . '</td>';
                            echo '<td>'. ($row['Estado']==1 ? 'Activo' : 'Inactivo') . '</td>';
                            echo '<td>'. $row['Descripcion'] . '</td>';
                            //echo '<td>'. $row['ID_Sucursal'] . '</td>';
                            echo '<td>
<a class="btn btn-success" href="borrarUsuario.php?ID_Usuario='.$row['ID_Usuario'].'">Borrar</a> 
<a class="btn btn-success" href="modificarUsuario.php?ID_Usuario='.$row['ID_Usuario'].'">Actualizar</a> 
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
