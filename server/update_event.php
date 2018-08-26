<?php
   require('./conector.php');

  session_start();
  if (isset($_SESSION['username'])) {
         $con = new ConectorBD('localhost', 'user_agenda', '12345');
         if ($con->initConexion('agenda_db')=='OK') {
             $id = $_POST['id'];
             $start_date = $_POST['start_date'];
             $end_date = $_POST['end_date'];
             $start_hour = $_POST['start_hour'];
             $end_hour = $_POST['end_hour'];


             $con->actualizarEvento($id,$start_date, $start_hour, $end_date,$end_hour);             
             $response['msg']= 'OK';             
        }else {
            $response['msg']= 'No se pudo conectar a la base de datos';
        } 
        $con->cerrarConexion();
  }else {
    $response['msg']= 'No se ha iniciado una sesión';
  }  
  echo json_encode($response);

$self = $_SERVER['PHP_SELF']; 
header("refresh:100; url=$self")

 ?>
