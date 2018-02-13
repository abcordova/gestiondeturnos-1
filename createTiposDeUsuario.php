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

        // keep track post values
        $descripcion = $_POST['descripcion'];
        $IDEmpresaS = $_POST['IDEmpresaS'];


        if ( !empty($IDEmpresaS)) {// validate input
		$valid = true;
		if (empty($descripcion)) {
		    $descripcionError = 'Por favor ingrese Descripcion';
		    $valid = false;
		}
	}
	             
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Tipos_Usuario (Descripcion,ID_Empresa) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($descripcion,$_SESSION['ID_Empresa']));
            Database::disconnect();
            //header("Location: indexSucursales.php");
	    echo "<script>location.href='indexTiposDeUsuario.php';</script>";
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
                        <h3>Creacion de Tipos de Usuarios</h3>
                    </div>
             
                    <form class="form-horizontal" action="createTiposDeUsuario.php" method="post">
                      <div class="control-group <?php echo !empty($descripcionError)?'error':'';?>">
                        <label class="control-label">Descripcion</label>
                        <div class="controls">
                            <input name="descripcion" type="text"  placeholder="Descripcion" value="<?php echo !empty($descripcion)?$descripcion:'';?>">
                            <?php if (!empty($descripcionError)): ?>
                                <span class="help-inline"><?php echo $descripcionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
	              <input name="IDEmpresaS" type="hidden"  value="<?php echo $_SESSION['ID_Empresa'];?>">

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Crear</button>
                          <a class="btn" href="indexTiposDeUsuario.php">Volver</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
