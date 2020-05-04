<?php
class Venta
{
    public $email;
    public $tipo;
    public $monto;
    public $sabor;
    public $fecha;

    public function __construct($email, $tipo, $monto, $sabor, $fecha)
    {
        $this->email = $email;
        $this->tipo = $tipo;
        $this->monto = $monto;
        $this->sabor = $sabor;
        $this->fecha = $fecha;
    }
}