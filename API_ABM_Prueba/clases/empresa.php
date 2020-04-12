<?php
    /**
     * Nota: Si no le ponia los modificadores de visibilidad
     * me tiraba error de "unexpected }"
     */

    //Documentos/archivos requeridos
    require_once "iGetSomeData.php";
    
    class Empresa implements iGetSomeData{
        //Variables
        protected $empleado;
        protected $area;
        protected $arrayDeDatos;

        //Constructor
        function __construct($empleado, $area){
            $this->empleado = $empleado;
            $this->area = $area;
            $arrayDeDatos = array($this->empleado, $this->area);
        }

        public function getInfo(){
            return json_encode($this->arrayDeDatos);
        }
    }
?>