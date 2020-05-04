<?php
class Persona
{
    public $id;
    public $nombre;
    public $dni;
    public $obra_social;
    public $clave;
    public $tipo;

    public function __construct($nombre, $dni, $obra_social, $clave, $tipo)
    {
        //Creo un ID random con la palabra id incluida en el
        $this->id = uniqid('id');
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->obra_social = $obra_social;
        $this->clave = $clave;
        $this->tipo = $tipo;
    }
}