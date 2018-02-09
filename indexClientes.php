<?php
session_start();
if (isset($_SESSION['autentificado'])) {
include("Header_menu.php");
}else{
header("Location: index.php");
}
     
    if ( !empty($_POST)) {


         
        // keep track post values
        //$ID_Empresa = $_POST['ID_Empresa'];
        $_SESSION['ID_Empresa'] = $_POST['ID_Empresa'];
       
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="alertify/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="alertify/css/themes/default.css">

    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="alertify/alertify.js"></script>
    <script src="js/funciones.js"></script>
   
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Clientes</h3>
            </div>
            <div id="tabla" class="row">
                <p>
            		
                 <a href="#modal2" class="btn btn-success" data-toggle="modal"> Crear </a>
                 <a class="btn" href="indexEmpresas.php">Volver</a>
            		 
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>E-mail</th>
                      <th>Telefono</th>
                      <th>Direccion</th>
                      <th>Hash Telefono</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                       include 'classCliente.php';
                       foreach (Cliente::SeleCliente($_SESSION['ID_Empresa']) as $rowc){
                                                         

                                $data =$rowc[0]."||".
                                        $rowc[2]."||".
                                        $rowc[3]."||".
                                        $rowc[4]."||".
                                        $rowc[5]."||".
                                        $rowc[7];
                                
                             
                                echo '<tr>';
                                echo '<td>'. $rowc['Nombre'] . '</td>';
                                echo '<td>'. $rowc['Apellido'] . '</td>';
                                echo '<td>'. $rowc['Email'] . '</td>';
                                echo '<td>'. $rowc['Telefono'] . '</td>';
                                echo '<td>'. $rowc['Direccion'] . '</td>';
                                echo '<td>'. $rowc['Mobile_HASH'] . '</td>';
                                echo '<td>';


                          ?> 
                                
                               <a href="#modal1" class="btn btn-success" data-toggle="modal" onclick=agregaform('<?php echo $data ?>')> Actualizar </a>
                                                           
                
                               </tr>
                       
                      <?php
                        }
                      ?> 
                      
                  
                  </tbody>
                </table>
          </div>
          <!--VENTANA MODAL DE ACTUALIZAR-->
          <div class="modal fade" id="modal1">
                <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                   <button type "button" class="close" data-dismiss="modal" arial-label="Close">
                                     &times;
                                   </button>
                                   <h5 class="modal-title">ACTUALIZAR CLIENTE</h5>
                            </div>       
                            <div class="modal-body">
                                      <input type="hide"  id="ClienId" name=""></input>
                                      <label >Nombre:</label>
                                      <input class="form-control"  type="text" id="ClienNombre"></input>
                                      <label >Apellido:</label>
                                      <input class="form-control"  type="text" id="ClienApellido"></input>
                                      <label >Email:</label>
                                      <input class="form-control"  type="text" id="ClienEmail"></input>
                                      <label >Telefono:</label>
                                      <input class="form-control"  type="text" id="ClienTelefono"></input>
                                      <label >Direccion:</label>
                                      <input class="form-control"  type="text" id="ClienDireccion"></input>
                            </div>      
                            <div class="modal-footer">
                                      <button type "button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                      <button type "button" class="btn btn-primary" data-dismiss="modal" id="actualizarCliente">Guardar</button>
                            </div>
                      </div>               
                </div>                 
          
          </div><!--FIN DE LA VENTANA MODAL ACTUALIZAR  -->        
         

          <!--VENTANA MODAL DE CREAR-->
          <div class="modal fade" id="modal2">
                <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                   <button type "button" class="close" data-dismiss="modal" arial-label="Close">
                                     &times;
                                   </button>
                                   <h5 class="modal-title">CREAR NUEVO CLIENTE</h5>
                            </div>       
                            <div class="modal-body">
                                      
                                      <label >Nombre:</label>
                                      <input class="form-control"  type="text" id="ClienNombre2"></input>
                                      <label >Apellido:</label>
                                      <input class="form-control"  type="text" id="ClienApellido2"></input>
                                      <label >Email:</label>
                                      <input class="form-control"  type="text" id="ClienEmail2"></input>
                                      <label >Telefono:</label>
                                      <input class="form-control"  type="text" id="ClienTelefono2"></input>
                                      <label >Direccion:</label>
                                      <input class="form-control"  type="text" id="ClienDireccion2"></input>
                            </div>      
                            <div class="modal-footer">
                                      <button type "button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                      <button type "button" class="btn btn-primary" data-dismiss="modal" id="createCliente">Guardar</button>
                            </div>
                      </div>               
                </div>                 
          
          </div><!--FIN DE LA VENTANA MODAL CREAR --> 
    </div> <!-- /container -->
     <script type="text/javascript">
      
      $('#actualizarCliente').click(function(){
        updateCliente();


      });
    </script>        
       
    <script type="text/javascript">
      
      $('#createCliente').click(function(){
        
       createCliente();


      });
    </script>
      

    </body>
</html>