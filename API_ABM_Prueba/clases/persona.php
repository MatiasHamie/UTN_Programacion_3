<?php
    /**
     * Nota: Si no le ponia los modificadores de visibilidad
     * me tiraba error de "unexpected }"
     */

    //Documentos/archivos requeridos
    require_once "iGetSomeData.php";
    require_once "C:/xampp/htdocs/UTN_Programacion_3/API_ABM_Prueba/archivos/escribir.php";
    require_once "C:/xampp/htdocs/UTN_Programacion_3/API_ABM_Prueba/archivos/leer.php";

    class Persona implements iGetSomeData{
        //Variables objeto
        protected $nombre;
        protected $edad;
        protected $arrayDeDatos;

        //Variables archivo
        protected $filePath;
        protected $arrayStrings;

        //Constructor
        function __construct($nombre = "", $edad = ""){
            $this->filePath = "C:/xampp/htdocs/UTN_Programacion_3/API_ABM_Prueba/archivos/objetos_en_texto.txt";
            $this->nombre = $nombre;
            $this->edad = $edad;
            $this->arrayDeDatos = array($this->nombre, $this->edad);
        }

        public function getInfo(){
            return json_encode($this->arrayDeDatos);
        }

        public function EscribirArchivo(){
            var_dump($this->arrayDeDatos);
            Escribir::EscribirObjetoTxt($this->filePath,$this->arrayDeDatos);
        }

        public function LeerArchivo(){

            $arraySerializado =  Leer::LeerObjetoTxt($this->filePath);
            
            for ($i=0; $arraySerializado[$i] != "" ; $i++) { 
                $this->arrayStrings = unserialize($arraySerializado[$i]);
                echo "<br>" . $this->arrayStrings[0];
                // array_push($this->arrayDeDatos,new Persona($this->arrayStrings[0],$this->arrayStrings[1]));
            }

            // var_dump($arrayDeDatos);

            // return $this->arrayDeDatos;
        }
    }
?>