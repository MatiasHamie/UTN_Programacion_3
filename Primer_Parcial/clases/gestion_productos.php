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
                isset($post_request['tipo']) && isset($post_request['precio']) && isset($post_request['stock']) &&
                isset($post_request['sabor']) && isset($_FILES['foto'])
            ) {
                $producto = new Producto($post_request['tipo'], $post_request['precio'], $post_request['stock'], $post_request['sabor'], $_FILES['foto']);

                return Gestion_Archivos::Guardar_Producto($producto, $directorio_productos);
            }
        } else {
            return Response::JsendResponse("Fail", "Producto recibido nulo");
        }
    }

    public static function ProductosRegistrados($directorio_productos)
    {
        if (isset($directorio_productos)) {
            $productos_registrados = Gestion_Archivos::Leer_Productos($directorio_productos);
            //Si no recibo un producto especifico para ver si existe retorno todos los productos
            return $productos_registrados;
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

    public static function GetPizza($directorio_productos, $tipo, $sabor)
    {
        $pizzas_registradas = self::ProductosRegistrados($directorio_productos);

        foreach ($pizzas_registradas as $key => $pizza_leida) {
            if (($pizza_leida->tipo == $tipo) && ($pizza_leida->sabor == $sabor)) {
                return $pizza_leida;
            }
        }
    }

    public static function VenderProducto($directorio_productos, $tipo, $sabor)
    {
        //Envio a productos registrados con el id del producto a buscar, y me devuelve null o el producto
        $pizzas_registradas = self::ProductosRegistrados($directorio_productos);

        foreach ($pizzas_registradas as $key => $pizza_leida) {
            if (($pizza_leida->tipo == $tipo) && ($pizza_leida->sabor == $sabor) && ($pizza_leida->stock > 0)) {
                $pizza_leida->stock -= 1;
                return Gestion_Archivos::Guardar_Producto($pizza_leida, $directorio_productos, 'modificar');
            } else {
                return Response::JsendResponse("Fail", "El stock almacenado es insuficiente");
            }
        }

        // if (isset($producto_a_modificar)) {
        //     if ($producto_a_modificar->stock >= $cantidad) {
        //         $producto_a_modificar->stock -= $cantidad;
        //         return Gestion_Archivos::Guardar_Producto($producto_a_modificar, $directorio_productos, 'modificar');
        //     } else {
        //         return Response::JsendResponse("Fail", "El stock almacenado es insuficiente");
        //     }
        // } else {
        //     return Response::JsendResponse("Fail", "El producto no existe");
        // }
    }

    public static function RegistrarVenta($directorio_ventas, $venta)
    {
        return Gestion_Archivos::Guardar_Venta($venta, $directorio_ventas);
    }
}
