<?php
    //include("mainfile.php");
    include 'Database.php';
   $pdo = Database::connect();
   $sql = "select * from Usuarios where Username like '".$_POST['username']."' and Password like '".$_POST['password']."' and Estado=1
	   and RecDel=''";

   Database::disconnect();
//$result = $db->sql_query("select * from usuarios where usuario like '$_POST[usuario]' and pass like '$_POST[pass]'");
//   	$row = $db->sql_fetchrow($result);
    foreach ($pdo->query($sql) as $row) {
    $pass = $row['Password'];
    $usuario = $row['Username'];
    $id_usuario = $row['ID_Usuario'];
}	

       if ($_POST['username'] == $usuario && $_POST['password'] == $pass && isset($usuario) ){
//usuario y contraseña válidos
//defino una sesion y guardo datos
session_start();
//session_register("autentificado");
$_SESSION["autentificado"] = "SI";
$_SESSION["usuario"] = $usuario;
$_SESSION["id_usuario"] = $id_usuario;
//Asigna Empresa
$pdo = Database::connect();
if ($_SESSION['usuario'] == "turnosadmin"){
$_SESSION["ID_Empresa"] = 0;
$_SESSION["Empresa_Nombre"] = "Aldamada";
}else{
$sql = "SELECT * FROM Empresas E
   left join Usuario_Empresa_Sucursal UES on E.ID_Empresa=UES.ID_Empresa
   where UES.ID_Usuario='".$_SESSION['id_usuario']."' and E.RecDel='' and UES.RecDel=''	   
   ORDER BY Nombre ASC
   Limit 1";

   foreach ($pdo->query($sql) as $row) {
	$_SESSION["ID_Empresa"] = $row['ID_Empresa'];
	$_SESSION["Empresa_Nombre"] = $row['Nombre'];
   }
}		
Database::disconnect();

header ("Location: indexEmpresas.php");
}else {
//si no existe le mando otra vez a la portada
header("Location: index.php?login=fallido");
};

?>
