<?php
  class ConectorBD
  {
    private $host;
    private $user;
    private $password;
    private $conexion;
    

    function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }

    function initConexion($nombre_db){
        try {
            mysqli_report(MYSQLI_REPORT_ALL);
            $this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);       
            return 'OK';
        } catch (Exception $e) {
            return 'ERROR FATAL :'.$e->getMessage();            
        }
    }


    function getConexion(){
      return $this->conexion;
    }

    function cerrarConexion(){
     // $this->conexion->close();
        try{
            mysqli_report(MYSQLI_REPORT_ALL);
            $this->conexion->close();      
        }catch(Exception $ex){            
        }
    }


    function ejecutarQuery($query){
      mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
      return $this->conexion->query($query);
    }
    //Inserta nuevos usuarios a la base de datos
    function insertarUsuario($codigo_u, $nombrecompleto_u, $correo_u, $fechanacimiento_u, $password_u){
         $sql = "INSERT INTO usuarios (codigo_u, nombrecompleto_u, correo_u, fechanacimiento_u, password_u) VALUES (0,'$nombrecompleto_u', '$correo_u','$fechanacimiento_u','$password_u')";         
        return $this->ejecutarQuery($sql);
    }


    function consultarUsuario($usuario){
        $sql = "SELECT correo_u, password_u FROM usuarios WHERE correo_u ='$usuario'";       
        return $this->ejecutarQuery($sql);
    }

    function obtenerIdUsuario($usuario){
        $sql = "SELECT codigo_u FROM usuarios WHERE correo_u ='$usuario'";       
        return $this->ejecutarQuery($sql);
    }

    function insertarEvento($codigo_e, $titulo_e, $fechainicio_e, $horainicio_e, $fechafin_e, $horafin_e, $usu_e, $diaentero_e ){
         $sql = "insert into eventos (codigo_e, titulo_e, fechainicio_e, horainicio_e, fechafin_e, horafin_e, usu_e, diaentero_e) VALUES(0,'$titulo_e', '$fechainicio_e', '$horainicio_e', '$fechafin_e','$horafin_e','$usu_e','$diaentero_e');";         
        return $this->ejecutarQuery($sql);
    }


    function obtenerEventos($IdUsuario){
        $sql = "select codigo_e, titulo_e, fechainicio_e, horainicio_e, fechafin_e, horafin_e, diaentero_e FROM eventos where usu_e = $IdUsuario;";       
        return $this->ejecutarQuery($sql);
    }

    function eliminarEvento($id){
        $sql = "DELETE from eventos WHERE codigo_e = $id ;";       
        return $this->ejecutarQuery($sql);
    }

    function actualizarEvento($id, $fechainicio_e, $horainicio_e, $fechafin_e, $horafin_e){
        $sql = "update eventos SET fechainicio_e = '$fechainicio_e' , horainicio_e = '$horainicio_e', fechafin_e = '$fechafin_e', horafin_e = '$horafin_e' WHERE codigo_e = $id;";       
        return $this->ejecutarQuery($sql);
    }
}

?>
