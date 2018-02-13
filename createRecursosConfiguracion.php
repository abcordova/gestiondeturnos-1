<?php
session_start();
if (isset($_SESSION['autentificado'])) {
include("Header_menu.php");
}else{
header("Location: index.php");
}


     
    require 'Database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $descripcionError = null;
        $unidadError = null;

        // keep track post values
        $descripcion = $_POST['descripcion'];
        $unidad = $_POST['unidad'];
        $IDEmpresaS = $_POST['IDEmpresaS'];


        if ( !empty($IDEmpresaS)) {// validate input
		$valid = true;
		if (empty($descripcion)) {
		    $descripcionError = 'Por favor ingrese Descripcion';
		    $valid = false;
		}
		if (empty($unidad)) {
		    $unidadError = 'Por favor ingrese Unidad Minima de Tiempo';
		    $valid = false;
		}

	}
	             
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Recursos_Configuracion (Descripcion,ID_Empresa,Unidad_Minima_Tiempo) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($descripcion,$_SESSION['ID_Empresa'],$unidad));
            Database::disconnect();
            //header("Location: indexSucursales.php");
	    echo "<script>location.href='indexRecursosConfiguracion.php';</script>";
	    die();
        }
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
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Creacion de Configuracion de Recursos</h3>
                    </div>
             
                    <form class="form-horizontal" action="createRecursosConfiguracion.php" method="post">
                      <div class="control-group <?php echo !empty($descripcionError)?'error':'';?>">
                        <label class="control-label">Descripcion</label>
                        <div class="controls">
                            <input name="descripcion" type="text"  placeholder="Descripcion" value="<?php echo !empty($descripcion)?$descripcion:'';?>">
                            <?php if (!empty($descripcionError)): ?>
                                <span class="help-inline"><?php echo $descripcionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
		      <div class="control-group <?php echo !empty($unidadError)?'error':'';?>">
                        <label class="control-label">Unidad Minima Asignacion</label>
                        <div class="controls">
                            <input name="unidad" type="number"  placeholder="Unidad Minima en Minutos" value="<?php echo !empty($unidad)?$unidad:'';?>">
                            <?php if (!empty($unidadError)): ?>
                                <span class="help-inline"><?php echo $unidadError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
	              <input name="IDEmpresaS" type="hidden"  value="<?php echo $_SESSION['ID_Empresa'];?>">

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Crear</button>
                          <a class="btn" href="indexRecursosConfiguracion.php">Volver</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
