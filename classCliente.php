<?php

class Cliente {
//	var ID_Cliente;
	private $ID_Empresa;
	private $Nombre;
	private $Apellido;
	private $Direccion;
	private $Email;
	private $Telefono;
	private $Mobile_HASH;
	private $RecDel;

	function Cliente($idE,$N,$A,$D,$E,$T,$MH,$R)
	{
		//$this->ID_Cliente = $idC; 
		$this->ID_Empresa = $idE;
		$this->Nombre = $N;
		$this->Apellido = $A;
		$this->Direccion = $D;
		$this->Email = $E;
		$this->Telefono =$T;
		$this->Mobile_HASH =$MH;
		$this->RecDel = $R;
	}
	public function AltaCliente () {

		include 'Database.php';
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO Clientes (nombre,apellido, email, telefono, mobile_hash, ID_Empresa,Direccion,RecDel) values(?, ?, ? , ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($this->Nombre,$this->Apellido, $this->Email, $this->Telefono, "",$this->ID_Empresa,$this->Direccion,""));
        Database::disconnect();
        echo "LISTO";

	}

	public function BajaCliente ($idCliente) {

		include 'Database.php';
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE Clientes SET RecDel = 'DELET' WHERE ID_Cliente = ".$idCliente;
        $q = $pdo->prepare($sql);
        $q->execute();
        Database::disconnect();
            
	}

	public function ModiCliente($idCliente){
		include 'Database.php';
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE Clientes SET Nombre = '$this->Nombre', Apellido = '$this->Apellido', Direccion = '$this->Direccion', Email = '$this->Email', Telefono = '$this->Telefono', Mobile_HASH = '', RecDel = '' WHERE ID_Cliente = '$idCliente'";	
        $q = $pdo->prepare($sql);
        $q->execute();
        Database::disconnect();
        return $q;
        
        

	}

	public function SeleCliente($idEmpresa){
		include 'Database.php';
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Clientes WHERE ID_Empresa='$idEmpresa'AND RecDel=''ORDER BY Nombre ASC";
		$q = $pdo->prepare($sql);
        $q->execute();
        return $q;
        
	}
}


//PRUEBAS
/////////////////////////////////////////////
//ALTA
//$persona = new Cliente (2,'Victor','Trujillo','dire','vic@gmail.com','4444','x','z');
//$persona->AltaCliente();
///////////////////////////////////////////
//BAJA
//Cliente::BajaCliente(2);
////////////////////////////////
//MODIFICACION
//$persona = new Cliente (2,'SEMILLIN','IPESA','dire','vic@gmail.com','4444','x','z');
//$persona->ModiCliente(14);
////////////////////////////////
//SELECCION DE CLIENTES POR EMPRESA
//Cliente::SeleCliente(2);



?>