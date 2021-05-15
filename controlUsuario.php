<?php

    //PRIMER NOS ASEGURAREMOS QUE SE LEA EL POST

    //HAREMOS PRIMERO EL PASO LARGO, que es reiciblros:
    //Entre [] se pone el nombre del atributo name del formulario html
    require 'entidades.php';
    require_once "paramBD.php";

    
    //Aca vamos a generar control a donde van a derivar oporeaciones
    if(isset($_POST["registrar"])){
        //osea si está registrar

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
        //Con esto hicimos insercion a BBD de prueba
        try{
            $conn = new PDO ("mysql:host=$host;dbname=$nombreBaseDatos", $usuario, $password);

            //Ahora vamos a forzar las excpeciones de conexión:
            //Este atributo que cargamos al elemetno de conexión es un try catch.
            //Si no indicamos ese atribute el CATCH de abajo NO CORRE.
            //Si el catch de abajo fuera solo de Excepcion, correria excepcion.
            //Pero no capturaría el PDOException.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query = $conn->prepare("INSERT INTO ALUMNOS (RUT, NOMBRE1, NOMBRE2, 
            APELLIDO1, APELLIDO2, CURSO, TIENECUENTA) VALUES (?, ?, ?, ?, ?, ? ,?)"); //Luego vamos a parametrizar esto, en el orden
            
            //Tenenos objeto de conexion, query preparado, nos queda:
            //Agregamos un cuaterniario, que dice si el rut esta vacío, enviar un null a la BBDD, si no se envía lo ingresado en el _POST
            $resultado = $query->execute([ (($rut == "") ? null : $nuevoAlumno->rut), $nuevoAlumno->nombre1, $nuevoAlumno->nombre2, $nuevoAlumno->apellido1,
            $nuevoAlumno->apellido2, $nuevoAlumno->curso, $nuevoAlumno->tieneCuenta]);
            //Execute reemplaza en el query en el orden secuencial
            
            /*Hay otras forma  */
            //Le doy nomrbe, lo bindeo y le paso el valor.
            if($resultado){
                echo "Registrado correctametne!";
            }else{
                echo "Registrado Incorrectamente!";
            }
        }catch(PDOException $pe){
            echo "Ocurrió un error: " . $pe->getMessage();
        }   
    }

    elseif(isset($_POST["actualizar"])){
        //Al copiar esto,  ya tenemos leido los campos del forumlario, se Podria poner arriba, fuera de las condiconiesl, pero se pone aca para no utilzarlo en Delete o select por eemplo
        $rut = $_POST["rut"];
        $nombre1 = $_POST["nombre1"];
        $nombre2 = $_POST["nombre2"];
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"];
        $curso = $_POST["cursos"];
    
        //LOS INPUT checbox tiene un problema, hay que controlarlos con if(isset)
        //Vemos si esta setiado. Isset ayuda a verificar si una variable viene declarada en el POST
        if(isset($_POST['tieneCuenta']) && $_POST['tieneCuenta'] == 'on'){ //CUANDO NO SE LE ACCIONA, aveces que ocurra que no llega al POST. Para asegurarse que tiene idetnfiiar, se pone isset, VE SI LO QU ESTA DEFINIDO; decalrado o en uso.
            $tieneCuenta = 1;
        }else{
            $tieneCuenta = 0;
        }

        $nuevoAlumno = new Alumno($rut, $nombre1, $nombre2, $apellido1, $apellido2, $curso, $tieneCuenta);
        try{
            //Esto siempre va, que es la conexión
            $conn = new PDO ("mysql:host=$host;dbname=$nombreBaseDatos", $usuario, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $queryUpdate = $conn->prepare("UPDATE ALUMNOS SET nombre1=:nombre1, nombre2=:nombre2,
            apellido1=:apellido1, apellido2=:apellido2, curso=:curso, tienecuenta=:tienecuenta WHERE rut=:rut");

            //Otra maner de verlo, como lo hicimos con INSERT
            /*$queryUpdate = $conn->prepare("UPDATE ALTUMNOS SET nombre1=?, nombre2=?,
            apellido1=?, curso=?, tienecuenta=? WHERE rut=:rut");*/

            $queryUpdate->bindValue("nombre1", $nuevoAlumno->nombre1);
            $queryUpdate->bindValue("nombre2", $nuevoAlumno->nombre2);
            $queryUpdate->bindValue("apellido1", $nuevoAlumno->apellido1);
            $queryUpdate->bindValue("apellido2", $nuevoAlumno->apellido2);
            $queryUpdate->bindValue("curso", $nuevoAlumno->curso);
            $queryUpdate->bindValue("tienecuenta", $nuevoAlumno->tieneCuenta);
            $queryUpdate->bindValue("rut", $nuevoAlumno->rut);

            $resultado = $queryUpdate->execute();
    
            if($resultado){
                echo "Actualizado correctametne!";
            }else{
                echo "Actualizado Incorrectamente!";
            }
        }catch(PDOException $pe){
            echo "Ocurrió un erro: " . $pe->getMessage();
        }   


    }
    elseif(isset($_POST["eliminar"])){
        //El delete solo necesitavmos el rut:
        $rut = $_POST["rut"];
        //Podemos usar diretactamente la variable $rut
        //O crear un objeto nuevo de Alumno, ahora la usaremos solo con la variable $rut

        //$nuevoAlumno = new Alumno($rut, $nombre1, $nombre2, $apellido1, $apellido2, $curso, $tieneCuenta);
        try{
            $conn = new PDO ("mysql:host=$host;dbname=$nombreBaseDatos", $usuario, $password);
          
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryDelete = $conn->prepare("DELETE FROM ALUMNOS WHERE rut=:rut");

            $queryDelete->bindValue("rut", $rut);

            $resultado = $queryDelete->execute();
    
            if($resultado){
                echo "Rut: ". $rut . ". Eliminado correctametne!";
            }else{
                echo "Eliminado Incorrectamente!";
            }
        }catch(PDOException $pe){
        echo "Ocurrió un erro: " . $pe->getMessage();
        }   
        
    }
    elseif(isset($_POST["consultar"])){

    }
    elseif(isset($_POST["consultarid"])){

    }
    else{
        echo "Ocurrió un erro: " . $pe->getMessage();
    }

?>