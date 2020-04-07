<?php
    require_once "IGetSomeData.php";
    class PaisConFronteras extends Pais implements IGetSomeData{
        protected $datosConFronteras;//Esto es lo q devuelvo
        private $fronteras;

        //Constructor
        public function __construct($pais){
            parent :: __construct($pais);

            $this->datosConFronteras = "";
            $this->fronteras = $pais[0]->borders;
        }

        //Implemento interfaz
        public function getInfo(){
            $this->datosConFronteras = "Continente: " . $this->continente . "<br>";
            $this->datosConFronteras .= "Nombre Pais: " . $this->nombre . "<br>";
            $this->datosConFronteras .= "Idioma: " . $this->idioma . "<br>";
            $this->datosConFronteras .= "Fronteras:";

            foreach ($this->fronteras as $posicion => $nombre) {
                $this->datosConFronteras .= $nombre . " / ";
            }

            return $this->datosConFronteras;
        }
    }
?>