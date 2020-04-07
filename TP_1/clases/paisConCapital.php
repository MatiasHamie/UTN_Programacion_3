<?php
    require_once "IGetSomeData.php";
    class PaisConCapital extends PaisConFronteras implements IGetSomeData{
        protected $datosConCapital;//Esto es lo q devuelvo
        private $capital;

        //Constructor
        public function __construct($pais){
            parent :: __construct($pais);

            $this->datosConCapital = "";
            $this->capital = $pais[0]->capital;
        }

        //Implemento interfaz
        public function getInfo(){
            $this->datosConCapital .= parent::getInfo() . "<br>";
            $this->datosConCapital .= "Capital: " . $this->capital;
            $this->datosConCapital .= "<br><br>";

            return $this->datosConCapital;
        }
    }
?>