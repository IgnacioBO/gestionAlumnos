<?php

    //PRIMER NOS ASEGURAREMOS QUE SE LEA EL POST

    //HAREMOS PRIMERO EL PASO LARGO, que es reiciblros:
    //Entre [] se pone el nombre del atributo name del formulario html
    require 'entidades.php';
    $rut = $_POST["rut"];
    $nombre1 = $_POST["nombre1"];
    $nombre2 = $_POST["nombre2"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $curso = $_POST["cursos"];
    //$tieneCuenta = $_POST["tieneCuenta"]

    //LOS INPUT checbox tiene un problema, hay que controlarlos con if(isset)
    


    if(isset($_POST['tieneCuenta']) && $_POST['tieneCuenta'] == 'on'){ //CUANDO NO SE LE ACCIONA, aveces que ocurra que no llega al POST. Para asegurarse que tiene idetnfiiar, se pone isset, VE SI LO QU ESTA DEFINIDO; decalrado o en uso.
        $tieneCuenta = 1;
    }else{
        $tieneCuenta = 0;
    }

    //EL checkbox que conrtola el tieneCuenta
    //Es un conrtol que tiene un defetfgo ucando pasa
    //Cuand esta en CHECK si genera el post, si esta en false, no lo genrea.

    //isset devuevel true o false, si tiene variable
    //Se haria uno para cada uno

    //Cuando estan aisaldos, uno por uno
    //Cuando es un conjuto de radio, se manda el del radio particular

    //isset es generico para cualquier
    //por ejemlo CUAND RUT este setiado ahi recien leo la variable, si no no.


    //Ahora le pasamos a este nuevo alumno los valores capturados del post.
    $nuevoAlumno = new Alumno($rut, $nombre1, $nombre2, $apellido1, $apellido2, $curso, $tieneCuenta);

    echo $nuevoAlumno -> nombreCompleto();
    echo $nuevoAlumno -> tieneCuenta;


    //echo $nuevoAlumno -> tieneCuenta; //Si es uncheck manda error

    //Para corroborar esto vamos al forumlario.
    // <form action="controlUsuario.php" method="POST">

    //AHORA HAREMOS UN CODIGO PARA CONECTARNOS A LA BBDD.
    //Vamos a phpmyadmin

    //Nos vamos a BBDD y creamos:
    //Nombre: bd_pruebas
    //utf8_spanish_ci

    //Y ahora creamos
    //UNa tabla con 7 (pq son 7 cosas en el registro)

    //Al agregar el RUt, vamos a donde dice "Índice" y ponemos Promary, aseguramos tb el mismo largo de 10 que establecemos.
    //Luego de crearla vamos a examinar, lo dejhamos ahi

    //Recordar nombre BBDD, nombre tabla y estructura
    //En examinar podemso velro

    //Ahora cerramo controlUsuario.php
    //Y CREAMOS un archivo paramBD.php dond estarán los parametro de Conexión a bbdd:
    //Luegoo otro archivo llamado: daoUsuario.php

    //AHORA COPIAMOS LO DEL DAO aca:
    //A otra clases le dará arquitectura de DAO. pq aca no servirá
    //Para este ejerccui el queda asi:
    //FORUMLARIO.html, controlUSUARIO, parambd, entidades.
    //El dao lo consumiermos mas adelante.

       require_once "paramBD.php";
    
    try{
        $conn = new PDO ("mysql:host=$host;dbname=$nombreBaseDatos", $usuario, $password);
        $query = $conn->prepare("INSERT INTO ALUMNOS (RUT, NOMBRE1, NOMBRE2, 
        APELLIDO1, APELLIDO2, CURSO, TIENECUENTA) VALUES (?, ?, ?, ?, ?, ? ,?)");
        //Tenenos objeto de conexion, query preparado, nos queda:

        $resultado = $query->execute([$nuevoAlumno->rut, $nuevoAlumno->nombre1, $nuevoAlumno->nombre2, $nuevoAlumno->apellido1,
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