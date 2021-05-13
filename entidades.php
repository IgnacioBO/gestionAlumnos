<?php
//CLase es una estrauctura abstracta relacionada al apradigma al POO
//Toda entidad que see relaciona con nuesdtro req pasa a aser una clase
//que se crean instancias de las clases con caracatersitcias
//CLASE: NOMBRE, CRACATAERITICAS Y ACCIONES y vinculamos propiedad, atributos y metodos
 //En el primer nivel DEFINIMO ATRIBUTOS

class Alumno{
    //Definimo atributos con var
    //Para una variable erea con $
    //Pra crear clase COMO ATRIBUTO HAY QUE ESPECIFICAR que es un varaibel con var

    var $rut;
    var $nombre1;
    var $nombre2;
    var $apellido1;
    var $apellido2;
    var $curso;
    var $tieneCuenta;
    private $ejemploAtributoPrivate;

    //SE PUEDEN HACER Private con:
    //private $rut; por ejemplo
    //var sería Public.
    //Tambien existe public y protected;

    //Ahora no pensaremos CON RELACIOENS ENTRE CLASES
    //AHORA SABEMOS QUE hay relacion entre ALUMNO y CURSO, por ahora no lo veremos
    //PQ ACA HAY COMPOSICION O ARGEGACION (CURSO Y ALUMNO, osea que curso se peude descomponeer)

    //Metodo constructor:
    //Para que una clase se peude isntanciar se debe tenr un constructor.
    //Aca se pueden poner los atributos que trabajará la clase:
    //Forma correcta de hacerlo:

    //Al declaar un metodo cosntructor y usamos EL MISMO NOMBRE DEL PARAMETRO CON ATRIBUTO
    //COMO ATRIBUTO TAMBIEN PUEDO PONER un int
    //Por ejemplo:
    //public function ejemplo (int $rut){}

    public function __construct($rut, $nombre1, $nombre2, $apellido1, $apellido2, $curso, $tieneCuenta)
    {
        //this -> rut es igual this.rut
        //El @ en C# era para escape de caracteres.
        $this->rut=$rut;
        $this->nombre1=$nombre1;
        $this->nombre2=$nombre2;
        $this->apellido1=$apellido1;
        $this->apellido2=$apellido2;
        $this->curso=$curso;
        $this->tieneCuenta=$tieneCuenta;
    }
    //Ahora vienen accedaroes (get y set?), pero no lo decalraremos, lo encapsularemos con el metodo cosntrutor

    //Metodos del objeto:
    public function nombreCompleto(){
        return "{$this->nombre1} {$this->nombre2} {$this->apellido1} {$this->apellido2}";
    }
    //No es nesesario hacer otro archivo para otras clases,
    //Podemos hacer denrto del mismo archivo ota clase

    }

    class Curso{
        var $id;
        var $nombre;

        public function __construct($id, $nombre)
        {
            $this->id=$id;
            $this->nombre=$nombre;
        }

        //Pra hacer un PROCEDIMIENTO que no RETORNA VALOR (void), basta solamente NO PONER RETURN.
        public function procedimientoEjemplo(){
            //Codigo sin return;
        }
    }
    //Se contiuna en probandoClase.php -->
?>