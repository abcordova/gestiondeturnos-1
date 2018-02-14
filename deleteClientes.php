<?php
session_start();
if (isset($_SESSION['autentificado'])) {

    }else{
    header("Location: index.php");
    }

$id =$_POST['idc'];

include 'classCliente.php';

echo Cliente::BajaCliente($id);



?>