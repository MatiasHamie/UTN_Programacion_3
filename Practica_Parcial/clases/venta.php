<?php
class Venta
{
    public $usuario;
    public $producto;

    public function __construct($usuario, $producto)
    {
        $this->usuario = $usuario;
        $this->producto = $producto;
    }
}