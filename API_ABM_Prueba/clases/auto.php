<?php
    /**
     * Nota: Si no le ponia los modificadores de visibilidad
     * me tiraba error de "unexpected }"
     */

    //Documentos/archivos requeridos
    require_once "iGetSomeData.php";
    
    class Auto implements iGetSomeData{
        //Variables
        protected $marca;
        protected $modelo;
        protected $arrayDeDatos;

        //Constructor
        function __construct($marca, $modelo){
            $this->marca = $marca;
            $this->modelo = $modelo;
            $arrayDeDatos = array($this->marca, $this->modelo);
        }

        public function getInfo(){
            return json_encode($this->arrayDeDatos);
        }
    }
?>