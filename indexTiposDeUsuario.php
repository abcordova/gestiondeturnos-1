<?php
session_start();
if (isset($_SESSION['autentificado'])) {
include("Header_menu.php");
}else{
header("Location: index.php");
}
   
    if ( !empty($_POST)) {

        // keep track post values
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
                <h3>Tipos de Usuario</h3>
            </div>
            <div class="row">
                <p>
		<form method="post" action="createTiposDeUsuario.php">
			<input name="IDEmpresa" type="hidden"  value="<?php echo $_SESSION['ID_Empresa'];?>">	
			<button type="submit" class="btn btn-success">Crear</button>
                        <a class="btn" href="indexUsuarios.php">Volver</a>
		</form> 
                </p>

                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Descripcion</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'Database.php';
		   $pdo = Database::connect();
                   $sql = "SELECT * FROM Tipos_Usuario where ID_Empresa='".$_SESSION['ID_Empresa']."' 
			   and RecDel=''
			   ORDER BY Descripcion ASC";
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
			    echo '<td>'. $row['Descripcion'] . '</td>';
                            echo '<td>
<a class="btn btn-success" href="read.php?ID_Tipo_Usuario='.$row['ID_Tipo_Usuario'].'">Borrar</a> 
<a class="btn btn-success" href="addDoc.php?ID_Tipo_Usuario='.$row['ID_Tipo_Usuario'].'">Actualizar</a> 
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
