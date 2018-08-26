<?php
	
	
	$conexion = new mysqli('localhost','user_agenda','12345','agenda_db');
    
    if($conexion->connect_error){
    	echo "No se pudo conectar a la base de datos";
    }else{
    	$password1 = password_hash('12345', PASSWORD_DEFAULT);
	    $password2 = password_hash('23456', PASSWORD_DEFAULT);
	    $password3 = password_hash('54321', PASSWORD_DEFAULT);
    	$conexion->query("INSERT INTO usuarios(codigo_u,nombrecompleto_u, correo_u, fechanacimiento_u, password_u) VALUES 
            (1,'Carlos Barrera','carlosb@gmail.com' , '1974-11-10', '$password1'),
    		(2,'Roberto Flores','roberto@gmail.com' , '1988-05-21', '$password2'),
    		(3,'Yuli Caceres','yuli@gmail.com' , '1994-01-25', '$password3');");
	    
        $conexion->query("INSERT INTO eventos(titulo_e, fechainicio_e, horainicio_e,fechafin_e,horafin_e, usu_e, diaentero_e)VALUES
            ('Reunion de trabajo','2018-08-15','10:00:00','2018-08-30','12:00:00',1,0),
            ('Cumpleaños abuela','2018-08-20',NULL,NULL,NULL,1,1),
            ('Conferencia','2018-08-30',NULL,NULL,NULL,1,1),
            ('Cita con Raul','2018-08-03','12:30:00','2018-08-30','13:00:00',2,0),
            ('Cumpleaños abuela','2018-08-14',NULL,NULL,NULL,2,1),
            ('Entrevista','2018-08-27','08:00:00',NULL,NULL,2,1);),
            ('Visita al observador','2018-08-05',NULL,NULL,NULL,3,1),
            ('Examen de quimica','2018-08-13',NULL,NULL,NULL,3,1),
            ('Entrevista laboral','2018-08-23','08:00:00','2018-08-23','10:00:00',3,0);");   

    	echo "3 registros insertados en tabla usuarios y 6 en tabla eventos";
    }
    $conexion->close();

?>