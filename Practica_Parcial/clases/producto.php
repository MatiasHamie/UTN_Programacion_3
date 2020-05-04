<?php
// use Ajaxray\PHPWatermark\Watermark;

class Producto
{
    public $id;
    public $producto;
    public $marca;
    public $precio;
    public $stock;
    public $foto;

    public function __construct($producto, $marca, $precio, $stock, $foto)
    {
        //Creo un ID random con la palabra id incluida en el
        $this->id = uniqid('idProducto_');
        $this->producto = $producto;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->foto = self::GuardarFoto($foto, $this->id);
        // $this->foto = $_FILES['foto'];
    }

    public static function GuardarFoto($foto, $id_producto)
    {
        //Obtengo la extension de la foto
        $extension_foto = explode('.', $foto['name']);
        $directorio_destino = __DIR__ . "./imagenes/" . $id_producto . "." . end($extension_foto);
        
        // $watermark = new Watermark($directorio_destino);
        // $watermark->withText("Practica_Parcial_MH", $foto['tmp_name']);
        //en tmp_name tengo guardado el directorio temporal de la foto
        move_uploaded_file($foto['tmp_name'], $directorio_destino);

        return $directorio_destino;
    }
}