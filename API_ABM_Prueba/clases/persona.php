<?php
    /**
     * Nota: Si no le ponia los modificadores de visibilidad
     * me tiraba error de "unexpected }"
     */

    //Documentos/archivos requeridos
    require_once "iGetSomeData.php";

    class Persona implements iGetSomeData{
        //Variables
        protected $nombre;
        protected $edad;
        protected $arrayDeDatos;

        //Constructor
        function __construct($nombre, $edad){
            $this->nombre = $nombre;
            $this->edad = $edad;
            $this->arrayDeDatos = array($this->nombre, $this->edad);
        }

        public function getInfo(){
            return json_encode($this->arrayDeDatos);
        }
    }
?>