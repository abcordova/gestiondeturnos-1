<?php
session_start();
if (isset($_SESSION['autentificado'])) {

    }else{
    header("Location: index.php");
    }
     
    require 'Database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        //$nombreError = null;
        //$apellidoError = null;
        //$emailError = null;
        //$telefonoError = null;
        //$direccionError = null;
         
        // keep track post values
//        $ID_Empresa = $_POST['ID_Empresa'];
        $ID_EmpresaC = $_POST['empresa'];
        $nombre = $_POST['nombre'];
    	$apellido = $_POST['apellido'];
    	$email = $_POST['email'];
    	$telefono = $_POST['telefono'];
    	$direccion = $_POST['direccion'];

         
        if ( !empty($ID_EmpresaC)) {// validate input

    		$valid = true;
    		if (empty($nombre)) {
    		    $nombreError = 'Por favor ingrese Nombre';
    		    $valid = false;
    		}

    		if (empty($apellido)) {
    		    $apellidoError = 'Por favor ingrese Apellido';
    		    $valid = false;
    		}
    		
    		if (empty($email)) {
    		    $emailError = 'Por favor ingrese E-mail';
    		    $valid = false;
    		}
    		if (empty($telefono)) {
    		    $telefonoError = 'Por favor ingrese Telefono';
    		    $valid = false;
    		}
    		if (empty($direccion)) {
    		    $direccionError = 'Por favor ingrese Direccion';
    		    $valid = false;
    		}

        } 
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Clientes (nombre,apellido, email, telefono, mobile_hash, ID_Empresa,Direccion,RecDel) values(?, ?, ? , ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            echo $q->execute(array($nombre,$apellido, $email, $telefono, "",$_SESSION['ID_Empresa'],$direccion,""));
            Database::disconnect();
            //header("Location: indexClientes.php");
	    
	    

        }
    }
?>
