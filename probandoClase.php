<?php

//Vamos a requerir, vamos a solicitar el llamados a entidades.php
//Lo que hacemos con esto, es Referencia al archivo donde se define la clase
//En php cuando queremos Utilizar elementos de otros archvios PHP
//Usamos la palabra reservada requiere
//Hacemos el vinculo de este archivo con el de entidades.php
//podemos consumir todas las claes del archivo y variable sdentro de este archivo
//PUeden ser utilizdas dentro de este archivo
//La idea es ocultar la definción, es similar a las capas, similar pero no igual
//Lo que sicede relaconado este archivo con el otro
//Oculto la definicon EN CIERTO grado
//Es como capas, PERO LAS CAPAS tiene mas integriadad con

//Similar al import o using de JAVA o C#, PERO NO ES TAN ASI.
//Pq import e using hacemos una referncia del ensamblado de un proyecto
//PQ aca no decimos que hay un ensamblado a partir de este archivo 

//Para hacer el vinculo hay otra sintaxis que es include
//include vs require:
//Require arroja ERROR CUANDO EL ARCHIVO NO ES VINCULADO o no se encuetra.
//Include no arroja error, es mas liviando.
    require 'entidades.php';

    //Creando un objeto a partir de la clase
    //Al hacer require podemso usarlo directamnte.
    $nuevoAlumno = new Alumno("1-9", "Juan", "Carlos", "Madariaga", "Carrasco", "1", 1);
    //Ahora con este elemento, podemos consumiur sus metodos

    // COn esto podemos acceder a sus ATRIBUTOES Y METODS:
    echo $nuevoAlumno->nombreCompleto();
    echo $nuevoAlumno->rut;
    //Con esto imprimimos el text en html.

    //EN PHP los accesadores se pueden crear
    //Pero se peude acceder diractemten a los atributos
    //Mi pregunta, se pueden ENCAPSULAR?
    //Se pueden encapsular, hay una forma de hacerlo.

    //POR DEFECTO NO ES POSIBLE CREAR OCMO ELEMENTOS PRIVADOS como lo hicimos recien.
    //Son como prpiedades estáticas, más abiertas.

    
    //AHORA CONTIUNA A ControlUsuaoris.php


?>