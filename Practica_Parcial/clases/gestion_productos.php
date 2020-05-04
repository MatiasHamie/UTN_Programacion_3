<?php

require_once __DIR__ . "./response.php";
require_once __DIR__ . "./producto.php";
require_once __DIR__ . "./gestion_archivos.php";

class Gestion_Productos
{
    public static function RegistrarProducto($directorio_productos, $post_request = null)
    {
        if (isset($post_request)) {
            if (
                isset($post_request['producto']) && isset($post_request['marca']) && isset($post_request['precio']) &&
                isset($post_request['stock']) && isset($_FILES['foto'])
            ) {
                $producto = new Producto($post_request['producto'], $post_request['marca'], $post_request['precio'], $post_request['stock'], $_FILES['foto']);

                return Gestion_Archivos::Guardar_Producto($producto, $directorio_productos);
            }
        } else {
            return Response::JsendResponse("Fail", "Producto recibido nulo");
        }
    }

    public static function ProductosRegistrados($directorio_productos, $id_producto = null)
    {
        if (isset($directorio_productos)) {
            $productos_registrados = Gestion_Archivos::Leer_Productos($directorio_productos);
            //Si no recibo un producto especifico para ver si existe retorno todos los productos
            if (!isset($id_producto)) {
                return Response::JsendResponse("success", array("Productos" => $productos_registrados));
            } else {
                return self::ExisteProducto($productos_registrados, $id_producto);
            }
        } else {
            return Response::JsendResponse("Fail", "Directorio de archivo invalido");
        }
    }

    public static function ExisteProducto($productos_registrados, $id_producto_recibido)
    {
        foreach ($productos_registrados as $indice => $producto) {
            if ($producto->id == $id_producto_recibido) {
                return $producto;
            }
        }

        return null;
    }

    public static function VenderProducto($directorio_productos, $id_producto, $cantidad)
    {
        //Envio a productos registrados con el id del producto a buscar, y me devuelve null o el producto
        $producto_a_modificar = self::ProductosRegistrados($directorio_productos, $id_producto);
        
        if (isset($producto_a_modificar)) {
            if ($producto_a_modificar->stock >= $cantidad) {
                $producto_a_modificar->stock -= $cantidad;         
                return Gestion_Archivos::Guardar_Producto($producto_a_modificar, $directorio_productos, 'modificar');
            } else {
                return Response::JsendResponse("Fail", "El stock almacenado es insuficiente");
            }
        } else {
            return Response::JsendResponse("Fail", "El producto no existe");
        }
    }

    public static function RegistrarVenta($directorio_ventas, $venta)
    {
        return Gestion_Archivos::Guardar_Venta($venta,$directorio_ventas);
    }
}
