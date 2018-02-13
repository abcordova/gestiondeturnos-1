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
        $nombreError = null;

        // keep track post values
        $nombre = $_POST['nombre'];
        $IDEmpresaS = $_POST['IDEmpresaS'];


        if ( !empty($IDEmpresaS)) {// validate input
		$valid = true;
		if (empty($nombre)) {
		    $nombreError = 'Por favor ingrese Nombre';
		    $valid = false;
		}
	}
	             
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Sucursales (nombre,ID_Empresa) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombre,$_SESSION['ID_Empresa']));
            Database::disconnect();
            //header("Location: indexSucursales.php");
	    echo "<script>location.href='indexSucursales.php';</script>";
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
                        <h3>Creacion de Sucursales</h3>
                    </div>
             
                    <form class="form-horizontal" action="createSucursales.php" method="post">
                      <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="nombre" type="text"  placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
	              <input name="IDEmpresaS" type="hidden"  value="<?php echo $_SESSION['ID_Empresa'];?>">

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Crear</button>
                          <a class="btn" href="indexSucursales.php">Volver</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
