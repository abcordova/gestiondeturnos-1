<?php

$id =$_POST['idc'];

include 'classCliente.php';

echo Cliente::BajaCliente($id);




?>