<?php
include 'classCliente.php';
$id =$_GET['ID_Cliente'];

?>

<<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form class="form-horizontal" action="createClientes.php" method="post">
			<div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="nombre" type="text"  placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($apellidoError)?'error':'';?>">
                        <label class="control-label">Apellido</label>
                        <div class="controls">
                            <input name="apellido" type="text"  placeholder="Apellido" value="<?php echo !empty($apellido)?$apellido:'';?>">
                            <?php if (!empty($apellidoError)): ?>
                                <span class="help-inline"><?php echo $apellidoError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                     <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">E-mail</label>
                        <div class="controls">
                            <input name="email" type="text"  placeholder="E-mail" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                     <div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
                        <label class="control-label">Telefono</label>
                        <div class="controls">
                            <input name="telefono" type="text"  placeholder="Telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
                            <?php if (!empty($telefonoError)): ?>
                                <span class="help-inline"><?php echo $telefonoError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                     <div class="control-group <?php echo !empty($direccionError)?'error':'';?>">
                        <label class="control-label">Direccion</label>
                        <div class="controls">
                            <input name="direccion" type="text"  placeholder="Direccion" value="<?php echo !empty($direccion)?$direccion:'';?>">
                            <?php if (!empty($direccionError)): ?>
                                <span class="help-inline"><?php echo $direccionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
	              <input name="ID_EmpresaC" type="hidden"  value="<?php echo $_SESSION['ID_Empresa'];?>">

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Crear</button>
                          <a class="btn" href="indexClientes.php">Volver</a>
                        </div>
                    </form>
                </div>
</body>
</html>