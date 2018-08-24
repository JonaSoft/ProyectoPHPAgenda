<?php
  require('./conector.php');
  $response = array();
  $eventos = array();
  session_start();
  if (isset($_SESSION['username'])) {
   $con = new ConectorBD('localhost', 'user_agenda', '12345');
   if ($con->initConexion('agenda_db')=='OK') {
        $resultado_consulta = $con->obtenerIdUsuario($_SESSION['username']);
        if ($resultado_consulta->num_rows != 0) {
             $fila = $resultado_consulta->fetch_assoc();
             $eventosUsuario =  $con->obtenerEventos($fila['codigo_u']);

    
              while($filaEvento = $eventosUsuario->fetch_assoc()){
                  $evento = array();
                  $evento['id'] = $filaEvento['codigo_e'];
                  $evento['title'] = $filaEvento['titulo_e'];
                  $evento['start'] =$filaEvento['fechainicio_e'];
                  $evento['end'] = $filaEvento['fechafin_e'];
                  if ($filaEvento['diaentero_e']==1){
                       $evento['allDay'] = true;
                  }else{
                       $evento['allDay'] = false;
                  }
                  array_push($eventos, $evento);
             
              }
              $response['msg']= 'OK';
        }else{                 
             $response['msg']= 'Problemas con la conexion de la sesion de usuario.';
        }
   }else{
       $response['msg']= 'Problemas con la conexion de la sesion de usuario.';
   }
  
  }else {
    $response['msg']= 'No se ha iniciado una sesión';
    $con->cerrarConexion();
  }  
  $response['eventos']= $eventos;
  echo json_encode($response);







 ?>
