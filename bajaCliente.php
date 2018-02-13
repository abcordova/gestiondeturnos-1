<?php


include 'classCliente.php';
$id =$_GET['ID_Cliente'];

Cliente::bajaCliente($id);
echo "<script>location.href='indexClientes.php';</script>";


?>

