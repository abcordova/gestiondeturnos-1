<?php
session_start();
if (isset($_SESSION['autentificado'])) {

    }else{
    header("Location: index.php");
    }

include "classCliente.php";

$id=$_POST['id'];
$n=$_POST['nombre'];
$a=$_POST['apellido'];
$e=$_POST['email'];
$d=$_POST['direccion'];
$t=$_POST['telefono'];


$data = new Cliente ('',$n,$a,$d,$e,$t,'','');


echo $data->ModiCliente($id);



?>