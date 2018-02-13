<?php
session_start();
if (isset($_SESSION['autentificado'])) {
include("Header_menu.php");
}else{
header("Location: index.php");
}
  
    if ( !empty($_POST)) {


         
        // keep track post values
        //$ID_Empresa = $_POST['ID_EmpresaR'];
        $_SESSION['ID_Empresa'] = $_POST['ID_EmpresaR'];
       
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
                <h3>Recursos</h3>
            </div>
            <div class="row">
                <p>
		<form method="post" action="createRecursos.php">
			<input name="ID_Empresa" type="hidden"  value="<?php echo $_SESSION['ID_Empresa'];?>">	
			<button type="submit" class="btn btn-success">Crear</button>
			<a class="btn" href="indexRecursosConfiguracion.php">Configuracion</a>	                        
			<a class="btn" href="indexEmpresas.php">Volver</a>
		</form> 

                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Descripcion</th>
                      <th>Estado</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'Database.php';
                   $pdo = Database::connect();
		   $sql = "SELECT * FROM Sucursales S
			   Left join Recursos_Sucursales RS on S.ID_Sucursal=RS.ID_Sucursal
		           Left join Recursos R on R.ID_Recurso=RS.ID_Recurso
			   where S.ID_Empresa= '".$_SESSION['ID_Empresa']."'
			   and S.RecDel='' and RS.RecDel='' and R.RecDel=''
			   group by RS.ID_Recurso, R.Descripcion, R.Estado		
			   ORDER BY R.Descripcion ASC";
                   foreach ($pdo->query($sql) as $rowc) {
                            echo '<tr>';
			    echo '<td>'. $rowc['Descripcion'] . '</td>';
                            echo '<td>'. ($rowc['Estado']==1 ? 'Activo' : 'Inactivo') . '</td>';                            
			    //echo '<td>'. $rowc['Estado'] . '</td>';
                            //echo '<td>'. $rowc['Nombre'] . '</td>';
                            echo '<td>
<a class="btn btn-success" href="borrarRecursos.php?ID_Recurso='.$rowc['ID_Recurso'].'">Borrar</a> 
<a class="btn btn-success" href="editarRecursos.php?ID_Recurso='.$rowc['ID_Recurso'].'">Actualizar</a> 
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
