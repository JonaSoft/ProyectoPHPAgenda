<?php
 
  require('./conector.php');
  
  $con = new ConectorBD('localhost','user_agenda','12345');

  $response['conexion'] = $con->initConexion('agenda_db');
  $usuario = $_POST['username'];
  $password = $_POST['password'];
  
  if ($response['conexion']=='OK') {    
      $resultado_consulta = $con->consultarUsuario($usuario);
     
    if ($resultado_consulta->num_rows != 0) {
      $fila = $resultado_consulta->fetch_assoc();
      if (password_verify($password, $fila['password_u'])) {
        $response['acceso'] = 'concedido';
        session_start();
        $_SESSION['username']=$fila['correo_u'];
        


      }else {
        $response['motivo'] = 'Contraseña incorrecta';
        $response['acceso'] = 'rechazado';
      }
    }else{
      $response['motivo'] = 'Email incorrecto';
      $response['acceso'] = 'rechazado';
    }   
   
  }
   
  echo json_encode($response);

  $con->cerrarConexion();




 ?>
