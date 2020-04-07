<?php
    require_once "IGetSomeData.php";
    class Pais implements IGetSomeData{
        protected $continente;
        protected $nombre;
        protected $idioma;
        protected $datosPais;//Esto es lo q devuelvo

        //Constructor
        public function __construct($pais){
            $this->continente = $pais[0]->region;
            $this->nombre = $pais[0]->name;
            $this->idioma = $pais[0]->languages[0]->nativeName;
            // var_dump($pais[0]->languages[0]->nativeName);
            // var_dump($pais);
        }

        //Implemento interfaz
        public function getInfo(){
            $this->datosPais = "Continente: " . $this->continente . "<br>";
            $this->datosPais .= "Nombre Pais: " . $this->nombre . "<br>";
            $this->datosPais .= "Idioma: " . $this->idioma . "<br>";

            return $this->datosPais;
        }
    }
?>