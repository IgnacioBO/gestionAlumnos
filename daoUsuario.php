<?php
    //Require a atributos de conexión.
    require_once "paramBD.php";
    require_once "controlUsuario.php";
    
    try{
        $conn = new PDO ("mysql:host=$host;dbname=$nombreBaseDatos", $usuario, $password);
        $query = $conn->prepare("INSERT INTO ALUMNOS (RUT, NOMBRE1, NOMBRE2, 
        APELLIDO1, APELLIDO2, CURSO, TIENECUENTA) VALUES (?, ?, ?, ?, ?, ? ,?)");
        //Tenenos objeto de conexion, query preparado, nos queda:

        $resultado = $query->execute([$nuevoAlumno->rut, $nuevoAlumno->nombre1, $nombreAlumno->nombre2, $nombreAlumno->apellido1,
        $nuevoAlumno->apellido2, $nuevoAlumno->curso, $nuevoAlumno->tieneCuenta]);
        
        if($resultado){
            echo "Registrado correctametne!";
        }else{
            echo "Registrado Incorrectamente!";
        }
    }catch(PDOException $pe){
        echo "Registrado Incorrectamente!";
    }

?>