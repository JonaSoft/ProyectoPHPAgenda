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
            return 'ERROR:'.$e->getMessage();            
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
    function insertarUsuario($usu_codigo, $usu_nombre_completo, $usu_correo, $usu_fechaNacimiento, $usu_password){
         $sql = "INSERT INTO usuarios (codigo_u, nombrecompleto_u, correo_u, fechanacimiento_u, password_u) VALUES (0,'$usu_nombre_completo', '$usu_correo','$usu_fechaNacimiento','$usu_password')";         
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

    function insertarEvento($eve_codigo, $eve_titulo, $eve_fecha_inicio, $eve_hora_inicio, $eve_fecha_fin, $eve_hora_fin, $eve_usu, $eve_dia_entero ){
         $sql = "insert into eventos (codigo_e, titulo_e, fechainicio_e, horainicio_e, fechafin_e, horafin_e, usu_e, diaentero_e) VALUES(0,'$eve_titulo', '$eve_fecha_inicio', '$eve_hora_inicio', '$eve_fecha_fin','$eve_hora_fin',$eve_usu,$eve_dia_entero);";         
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

    function actualizarEvento($id, $eve_fecha_inicio, $eve_hora_inicio, $eve_fecha_fin, $eve_hora_fin){
        $sql = "UPDATE eventos SET fechainicio_e = '$eve_fecha_inicio' , horainicio_e = '$eve_hora_inicio', fechafin_e = '$eve_fecha_fin', horafin_e = '$eve_hora_fin' WHERE codigo_e = '$id';";       
        return $this->ejecutarQuery($sql);
    }
}

?>
