<?php
require_once __DIR__ . "./clases/gestion_usuarios.php";
require_once __DIR__ . "./clases/gestion_productos.php";
require_once __DIR__ . "./clases/response.php";
require_once __DIR__ . "./vendor/autoload.php";
require_once __DIR__ . "./clases/venta.php";

$directorio_usuarios = "./usuarios.dat";
$directorio_productos = "./productos.json";
$directorio_ventas = "./ventas.dat";
$key = "Practica_Primer_Parcial_Programacion3_MNH";

if (isset($_SERVER['REQUEST_METHOD'])) {
    if (isset($_SERVER['PATH_INFO'])) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                switch ($_SERVER['PATH_INFO']) {
                    case '/usuario':
                        //Creo un usuario, si no se pudo, la misma funcion te avisa que hubo un error
                        echo Gestion_Usuarios::RegistrarUsuario($directorio_usuarios, $_POST);
                        break;
                    case '/login':
                        echo Gestion_Usuarios::LoginUsuario($directorio_usuarios, $_POST['nombre'], $_POST['clave']);
                        break;
                    case '/stock':
                        echo Gestion_Productos::RegistrarProducto($directorio_productos, $_POST);
                        break;
                    case '/ventas':
                        $usuario = Gestion_Usuarios::getUser(getallheaders(), $key);
                        if(!Gestion_Usuarios::EsAdmin($usuario)){
                            $respuesta = Gestion_Productos::VenderProducto($directorio_productos, $_POST['id_producto'], $_POST['cantidad']);
                            
                            if (json_decode($respuesta)->status == 'Success') {
                                $venta = new Venta($usuario, Gestion_Productos::ProductosRegistrados($directorio_productos,$_POST['id_producto']));
                                Gestion_Productos::RegistrarVenta($directorio_ventas, $venta);
                            }
                            echo $respuesta;
                        } else {
                            echo Response::JsendResponse("Fail","El usuario no es admin para poder ver los productos registrados");
                        }
                        break;
                    
                    default:
                        echo Response::JsendResponse("Error","Endpoint invalido");
                        break;
                }
                break;
            case 'GET':
                switch ($_SERVER['PATH_INFO']) {
                    case '/stock':
                        $usuario = Gestion_Usuarios::getUser(getallheaders(), $key);
                        echo Gestion_Productos::ProductosRegistrados($directorio_productos);
                        break;
                    case '/ventas':
                        //Decodifico el usuario
                        $usuario = Gestion_Usuarios::getUser(getallheaders(), $key);
                        //Y se lo envio a esta funcion, la misma ya se fija si es admin o no
                        echo Gestion_Archivos::VentasRealizadas($directorio_ventas, $usuario);
                        break;

                    default:
                        echo Response::JsendResponse("Error","Tipo de solicitud no valida");
                        break;
                }
        }
    } else {
        echo Response::JsendResponse("Error","No se encontro Endpoint");
    }
} else {
    echo Response::JsendResponse("Error","Método nulo");
}