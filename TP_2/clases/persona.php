<?php

//Directorios a utilizar
// require_once __DIR__ . "../archivos";

class Persona{
    public $email;
    public $clave;
    public $nombre;
    public $apellido;
    public $telefono;
    public $tipo;

    public function __construct($email, $clave, $nombre, $apellido, $telefono, $tipo)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->tipo = $tipo;
    }
}
