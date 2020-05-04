<?php
require_once __DIR__ . "./response.php";
require_once __DIR__ . "./gestion_productos.php";

class Gestion_Archivos
{
    public static function Guardar_Usuario($usuario, $directorio_archivo)
    {
        try {
            if (isset($usuario)) {
                //Leo los usuarios que ya tengo guardados, creo un array y hago push
                $usuarios_registrados = self::Leer_Usuarios($directorio_archivo);
    
                //Agrego a la persona recibida al array
                array_push($usuarios_registrados, $usuario);
    
                //Escribo el archivo
                $archivo_abierto = fopen($directorio_archivo, 'w');
                $caracteres_escritos = fwrite($archivo_abierto, serialize($usuarios_registrados));
                $retorno = ($caracteres_escritos > 0) ?
                    Response::JsendResponse("Success", "Se ha registrado y guardado el usuario") :
                    Response::JsendResponse("Fail", "No se pudo guardar el usuario");
                fclose($archivo_abierto);
                return $retorno;
            } else {
                echo Response::JsendResponse("Error", "No se recibio ningun usuario para registrar");
            }
        } catch (\Throwable $th) {
            return Response::JsendResponse("Excepcion", $th->getMessage());
        }
    }

    public static function Leer_Usuarios($directorio_archivo)
    {
        try {        
            if (filesize($directorio_archivo) < 1) {
                $fileSize = 20;
            } else {
                $fileSize = filesize($directorio_archivo);
            }

            //Leo el archivo y me guardo la info
            $archivo_abierto = fopen($directorio_archivo, 'r');
            $info_leida = fread($archivo_abierto, $fileSize);
            fclose($archivo_abierto);

            if ($info_leida == '') {
                //Si no leyó a nadie porque es la primera vez, inicializo un array vacio
                $usuarios_registrados = array();
            } else {
                //Deserializo los objetos
                $usuarios_registrados = unserialize($info_leida);
            }
        } catch (\Throwable $th) {
            return Response::JsendResponse("Excepcion", $th->getMessage());
        }


        return $usuarios_registrados;
    }

    public static function Guardar_Producto($producto, $directorio_archivo, $string_modificar = '')
    {
        try {
            if (isset($producto)) {
                //Leo los productos que ya tengo guardados, creo un array y hago push
                $productos_registrados = self::Leer_Productos($directorio_archivo);
    
                //Si llaman a esta funcion con la palabra modificar, es para mdificar el stock
                if ($string_modificar == 'modificar') {
                    $productos_registrados = self::ModificarStock($productos_registrados, $producto);
                    $respuesta_venta = Response::JsendResponse("Success", "Se ha registrado la venta");
                } else {

                    foreach ($productos_registrados as $key => $producto_leido) {
                        if($producto_leido->tipo == $producto->tipo){
                            if($producto_leido->sabor == $producto->sabor){
                                return Response::JsendResponse("Fail", "Producto ya existente");
                            }
                        }
                    }

                    array_push($productos_registrados, $producto);
                }
    
                //Escribo el archivo
                $archivo_abierto = fopen($directorio_archivo, 'w');
                $caracteres_escritos = fwrite($archivo_abierto, serialize($productos_registrados));
    
                $respuesta_producto = ($caracteres_escritos > 0) ?
                    Response::JsendResponse("Success", "Se ha registrado y guardado el producto") :
                    Response::JsendResponse("Fail", "No se pudo guardar el producto");
                fclose($archivo_abierto);
                    
                return ($string_modificar == 'modificar') ? $respuesta_venta : $respuesta_producto;
    
            } else {
                echo Response::JsendResponse("Error", "No se recibio ningun producto para registrar");
            }
        } catch (\Throwable $th) {
            return Response::JsendResponse("Excepcion", $th->getMessage());
        }
    }

    public static function Leer_Productos($directorio_archivo)
    {
        try {
            if (filesize($directorio_archivo) < 1) {
                $fileSize = 20;
            } else {
                $fileSize = filesize($directorio_archivo);
            }
    
            //Leo el archivo y me guardo la info
            $archivo_abierto = fopen($directorio_archivo, 'r');
            $info_leida = fread($archivo_abierto, $fileSize);
            fclose($archivo_abierto);
    
            if ($info_leida == '') {
                //Si no leyó a nadie porque es la primera vez, inicializo un array vacio
                $productos_registrados = array();
            } else {
                //Deserializo los objetos
                $productos_registrados = unserialize($info_leida);
            }
        } catch (\Throwable $th) {
            return Response::JsendResponse("Excepcion", $th->getMessage());
        }

        return $productos_registrados;
    }

    public static function ModificarStock($productos_registrados, $producto)
    {
        foreach ($productos_registrados as $key => &$pizza_leida) {
            if (($pizza_leida->tipo == $producto->tipo) && ($pizza_leida->sabor == $producto->sabor)) {
                $pizza_leida = $producto;
                return $productos_registrados;
            }
        }
    }

    public static function Guardar_Venta($venta, $directorio_archivo)
    {
        try {
            //Leo los productos que ya tengo guardados, creo un array y hago push
            $ventas_registradas = self::Leer_Ventas($directorio_archivo);
    
            array_push($ventas_registradas, $venta);
    
            //Escribo el archivo
            $archivo_abierto = fopen($directorio_archivo, 'w');
            $caracteres_escritos = fwrite($archivo_abierto, json_encode($ventas_registradas));
            $retorno = ($caracteres_escritos > 0) ?
                Response::JsendResponse("Success", "Se ha registrado y guardado la venta") :
                Response::JsendResponse("Fail", "No se pudo guardar la venta");
            fclose($archivo_abierto);
        } catch (\Throwable $th) {
            return Response::JsendResponse("Excepcion", $th->getMessage());
        }
        return $retorno;
    }

    public static function Leer_Ventas($directorio_archivo)
    {
        try {
            if (filesize($directorio_archivo) < 1) {
                $fileSize = 20;
            } else {
                $fileSize = filesize($directorio_archivo);
            }
    
            //Leo el archivo y me guardo la info
            $archivo_abierto = fopen($directorio_archivo, 'r');
            $info_leida = fread($archivo_abierto, $fileSize);
            fclose($archivo_abierto);
    
            if ($info_leida == '') {
                //Si no leyó a nadie porque es la primera vez, inicializo un array vacio
                $ventas_registradas = array();
            } else {
                //Deserializo los objetos
                $ventas_registradas = json_decode($info_leida);
            }
        } catch (\Throwable $th) {
            return Response::JsendResponse("Excepcion", $th->getMessage());
        }

        return $ventas_registradas;
    }

    public static function VentasRealizadas($directorio_archivo, $usuario)
    {
        $array_ventas_usuario = array();
        $ventas_leidas = self::Leer_Ventas($directorio_archivo);
        if (Gestion_Usuarios::EsEncargado($usuario)) {
            $monto_total = 0;
            foreach ($ventas_leidas as $key => $venta) {
                
                $monto_total += (float) $venta->monto;
            }
            return Response::JsendResponse("success", array("Monto total operaciones" => "ARS" . $monto_total,"Ventas_Realizadas" => $ventas_leidas));
        }
        foreach ($ventas_leidas as $key => $venta_leida) {
            if ($venta_leida->email == $usuario->email) {
                array_push($array_ventas_usuario, $venta_leida); 
            }
        }

        return Response::JsendResponse("success", array("Ventas_de_" . $usuario->email => $ventas_leidas));
    }
}
