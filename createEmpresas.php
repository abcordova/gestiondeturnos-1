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
        $descripcionError = null;
        $cuitError = null;
        $logoError = null; //sin implementar
         
        // keep track post values
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $cuit = $_POST['cuit'];
        $logo = $_POST['logo'];
         
        // validate input
        $valid = true;
        if (empty($nombre)) {
            $nombreError = 'Please enter Name';
            $valid = false;
        }

        if (empty($descripcion)) {
            $descripcionError = 'Please enter Obs';
            $valid = false;
        }
         
        if (empty($cuit)) {
            $cuitError = 'Please enter CUIT';
            $valid = false;
        }
        /*
        if (empty($logo)) {
            $logoError = 'Please enter LOGO';
            $valid = false;
        }
        */
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Empresas (Nombre,Descripcion,Cuit,Logo) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombre,$descripcion,$cuit,'mi logo'));
            Database::disconnect();
            //header("Location: indexEmpresas.php");
	    echo "<script>location.href='indexEmpresas.php';</script>";
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
                        <h3>Create a Empresas</h3>
                    </div>
             
                    <form class="form-horizontal" action="createEmpresas.php" method="post">
                      <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="nombre" type="text"  placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descripcionError)?'error':'';?>">
                        <label class="control-label">Descripcion</label>
                        <div class="controls">
                            <input name="descripcion" type="text"  placeholder="Descripcion" value="<?php echo !empty($descripcion)?$descripcion:'';?>">
                            <?php if (!empty($descripcionError)): ?>
                                <span class="help-inline"><?php echo $descripcionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($cuitError)?'error':'';?>">
                        <label class="control-label">CUIT</label>
                        <div class="controls">
                            <input name="cuit" type="text"  placeholder="Cuit" value="<?php echo !empty($cuit)?$cuit:'';?>">
                            <?php if (!empty($cuitError)): ?>
                                <span class="help-inline"><?php echo $cuitError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="indexEmpresas.php">Volver</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
