function createCliente() {


	  empresa=$('#EmpresaId').val(); 		
	  nombre=$('#ClienNombre2').val();
      apellido=$('#ClienApellido2').val();
      email=$('#ClienEmail2').val();
      telefono=$('#ClienTelefono2').val();
      direccion=$('#ClienDireccion2').val();

    cadena = "empresa=" + empresa +
    		 "&nombre=" + nombre +
			 "&apellido="+ apellido +
			 "&email=" + email +
			 "&telefono=" + telefono +
			 "&direccion=" + direccion;



	$.ajax({
		type:"POST",
		url:"createClientes.php",
		data: cadena,
		success:function(r){
			if(r){
				alertify.success("CORRECTO, Cliente creado :)");
				$("#tabla").load(" #tabla");		
			}else{
				alertify.error("VERIFICAR DATOS, el cliente no se pudo crear :(");
			}

		}

	})			  


}





function agregaform (datos){

	d=datos.split('||');

	$('#ClienId').val(d[0]);
	$('#ClienNombre').val(d[1]);
	$('#ClienApellido').val(d[2]);
	$('#ClienTelefono').val(d[3]);
	$('#ClienEmail').val(d[4]);
	$('#ClienDireccion').val(d[5]);
	
}

function updateCliente (){

	id=$('#ClienId').val();
	nombre=$('#ClienNombre').val();
	apellido=$('#ClienApellido').val();
	email=$('#ClienEmail').val();
	telefono=$('#ClienTelefono').val();
	direccion=$('#ClienDireccion').val();


	cadena = "id=" + id +
			 "&nombre=" + nombre +
			 "&apellido="+ apellido +
			 "&email=" + email +
			 "&telefono=" + telefono +
			 "&direccion=" + direccion;



	$.ajax({
		type:"POST",
		url:"updateCliente.php",
		data: cadena,
		success:function(r){
			if(r){
				alertify.success("Actualizacion Correcta :)");
				$("#tabla").load(" #tabla");		
			}else{
				alertify.error("NO se puedo Actualizar :(");
			}

		}

	})			 

}