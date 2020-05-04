<?php
// use Ajaxray\PHPWatermark\Watermark;

class Producto
{
    public $tipo;
    public $precio;
    public $stock;
    public $sabor;
    public $foto;

    public function __construct($tipo, $precio, $stock, $sabor, $foto)
    {
        $this->tipo = $tipo;
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->foto = self::GuardarFoto($foto, $this->tipo . $this->sabor);
        // $this->foto = $_FILES['foto'];
    }

    public static function GuardarFoto($foto, $tipo_pizza)
    {
        //Obtengo la extension de la foto
        $extension_foto = explode('.', $foto['name']);
        $directorio_destino = __DIR__ . "./imagenes/" . $tipo_pizza . "." . end($extension_foto);
        
        // $watermark = new Watermark($directorio_destino);
        // $watermark->withText("Practica_Parcial_MH", $foto['tmp_name']);
        //en tmp_name tengo guardado el directorio temporal de la foto
        move_uploaded_file($foto['tmp_name'], $directorio_destino);

        return $directorio_destino;
    }
}