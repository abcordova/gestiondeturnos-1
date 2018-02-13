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
        $estadoError = null;
         
        // keep track post values
        $ID_EmpresaR = $_POST['ID_EmpresaR'];
        $descripcion = $_POST['descripcion'];
	$estado = $_POST['estado'];

         
        if ( !empty($ID_EmpresaR)) {// validate input

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
            $sql = "INSERT INTO Recursos (Descripcion,Estado,ID_RecConfig) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($descripcion,$estado,""));

	    $ID_Recurso=$pdo->lastInsertId();
	    
	    $checkboxes = isset($_POST['arraysuc']) ? $_POST['arraysuc'] : array();
	    foreach($checkboxes as $value) {
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "INSERT INTO Recursos_Sucursales (ID_Recurso,ID_Sucursal) values(?, ?)";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($ID_Recurso,$value));
	    }
            Database::disconnect();
	    echo "<script>location.href='indexRecursos.php';</script>";
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
                        <h3>Creacion de Recursos</h3>
                    </div>
             
                    <form class="form-horizontal" action="createRecursos.php" method="post">
			<div class="control-group <?php echo !empty($descripcionError)?'error':'';?>">
                        <label class="control-label">Descripcion</label>
                        <div class="controls">
                            <input name="descripcion" type="text"  placeholder="Descripcion" value="<?php echo !empty($descripcion)?$descripcion:'';?>">
                            <?php if (!empty($descripcionError)): ?>
                                <span class="help-inline"><?php echo $descripcionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($estadoError)?'error':'';?>">
                        <label class="control-label">Estado</label>
                        <div class="controls">
				 <select name="estado">
				  <option value="1">Activo</option>
				  <option value="0">Inactivo</option>
				</select> 
                        </div>
                      </div>
                     <div class="control-group <?php echo !empty($sucError)?'error':'';?>">
                        <label class="control-label">Sucursales</label>
                        <div class="controls">
                  	<?php
	                   $pdor = Database::connect();
			   $sqlr = "SELECT * FROM Sucursales where ID_Empresa='".$_SESSION['ID_Empresa']."' 
				    and RecDel=''	
				    ORDER BY Nombre ASC";
	                   foreach ($pdor->query($sqlr) as $rowr) {
	                            echo '<tr><td>';
				    echo '<input type="checkbox" name="arraysuc[]" value="'.$rowr['ID_Sucursal'].'" class="checkbox" checked> '.$rowr['Nombre'].'<br>';
	                            echo '</td></tr>';
	                   }
	                   Database::disconnect();
	                  ?>
                        </div>
                      </div>
	              <input name="ID_EmpresaR" type="hidden"  value="<?php echo $_SESSION['ID_Empresa'];?>">

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Crear</button>
                          <a class="btn" href="indexRecursos.php">Volver</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
