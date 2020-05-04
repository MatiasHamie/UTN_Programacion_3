<?php
include_once './datos.php';

class Persona {
    public $nombre;
    public $apellido;
    public $legajo;

    public function __construct($nombre, $apellido, $legajo)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->legajo = $legajo;
    }

    public function save() {
        // return Datos::guardar('datos.txt', $this->toFile());
        return Datos::guardarJSON('datos.json', $this);
    }

    static public function find($id=0) {

        // $lista = Datos::leerTodo('datos.txt');
        $lista = Datos::leerJSON('datos.json');

        if  ($id == 0) {
            return $lista;
        }

        $personaEncontrada = '';
        foreach ($lista as $value) {
            # code...
            if ($value->legajo == $id) {
                $personaEncontrada = $value;
                break;
            }
        }

        return $personaEncontrada;
    }

    public function toFile() {

        return $this->nombre . '@' . $this->apellido . '@' . $this->legajo . PHP_EOL;
    }

    public function toJSON()
    {

        return json_encode($this);
    }
}