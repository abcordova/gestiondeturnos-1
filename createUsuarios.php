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
	$usernameError = null;
	$passwordError = null;
	$estadoError = null;
	$tipodeusuarioError = null;
         
        // keep track post values
        $ID_EmpresaU = $_POST['IDEmpresaU'];
        $nombre = $_POST['nombre'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$estado = $_POST['estado'];
	$tipodeusuario = $_POST['tipodeusuario'];
         
        if ( !empty($ID_EmpresaU)) {
	// validate input
        $valid = true;
        if (empty($nombre)) {
            $nombreError = 'Por favor ingrese Nombre';
            $valid = false;
        }

        if (empty($username)) {
            $usernameError = 'Por favor ingrese Nombre de Usuario';
            $valid = false;
        }
        
        if (empty($password)) {
            $passwordError = 'Por favor ingrese Password';
            $valid = false;
        }
        if (empty($estado)) {
            $estadoError = 'Por favor ingrese Estado';
            $valid = false;
        }
        if (empty($tipodeusuario)) {
            $tipodeusuarioError = 'Por favor Ingrese Tipo de Usuario';
            $valid = false;
        }
        } 
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Usuarios (nombre,username, password, estado, ID_Tipo_Usuario) values(?, ?, ? , ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombre,$username, $password, $estado, $tipodeusuario));

	    $ID_Usuario=$pdo->lastInsertId();
	    
	    $checkboxes = isset($_POST['arraysucu']) ? $_POST['arraysucu'] : array();
	    foreach($checkboxes as $value) {
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "INSERT INTO Usuario_Empresa_Sucursal (ID_Usuario,ID_Sucursal,ID_Empresa) values(?, ?, ?)";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($ID_Usuario,$value,$_SESSION['ID_Empresa']));
	    }

            Database::disconnect();
//            header("Location: indexUsuarios.php");
	    echo "<script>location.href='indexUsuarios.php';</script>";
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
                        <h3>Creacion de Usuarios</h3>
                    </div>
             
                    <form class="form-horizontal" action="createUsuarios.php" method="post">
                      <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="nombre" type="text"  placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
                        <label class="control-label">Username</label>
                        <div class="controls">
                            <input name="username" type="text"  placeholder="Username" value="<?php echo !empty($username)?$username:'';?>">
                            <?php if (!empty($usernameError)): ?>
                                <span class="help-inline"><?php echo $usernameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input name="password" type="text"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
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
                     <div class="control-group <?php echo !empty($tipodeusuarioError)?'error':'';?>">
                        <label class="control-label">Tipo de Usuario</label>
                        <div class="controls">
   				 <select name="tipodeusuario">                  	
				<?php
			           $pdor = Database::connect();
				   $sqlr = "SELECT * FROM Tipos_Usuario where ID_Empresa='".$_SESSION['ID_Empresa']."' 
					    and RecDel=''                     
					    ORDER BY Descripcion ASC";
			           foreach ($pdor->query($sqlr) as $rowr) {

					    echo '<option value="'.$rowr['ID_Tipo_Usuario'].'"> '.$rowr['Descripcion'].'</option>';

			           }
			           Database::disconnect();
			          ?>
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
				    echo '<input type="checkbox" name="arraysucu[]" value="'.$rowr['ID_Sucursal'].'" class="checkbox" checked> '.$rowr['Nombre'].'<br>';
	                            echo '</td></tr>';
	                   }
	                   Database::disconnect();
	                  ?>
                        </div>
                      </div>

	              <input name="IDEmpresaU" type="hidden"  value="<?php echo $_SESSION['ID_Empresa'];?>">


                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="indexUsuarios.php">Volver</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
