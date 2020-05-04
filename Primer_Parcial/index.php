<?php
require_once __DIR__ . "./clases/gestion_usuarios.php";
require_once __DIR__ . "./clases/gestion_productos.php";
require_once __DIR__ . "./clases/response.php";
require_once __DIR__ . "./vendor/autoload.php";
require_once __DIR__ . "./clases/venta.php";

$directorio_usuarios = "./users.dat";
$directorio_productos = "./productos.dat";
$directorio_ventas = "./ventas.dat";
$key = "pro3-parcial";

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
                        echo Gestion_Usuarios::LoginUsuario($directorio_usuarios, $_POST['email'], $_POST['clave'], $key);
                        break;
                    case '/pizzas':
                        $usuario = Gestion_Usuarios::getUser(getallheaders(), $key);
                        if (Gestion_Usuarios::EsEncargado($usuario)) {
                            // var_dump($_POST['tipo']);
                            if (($_POST['tipo'] != 'molde' && $_POST['tipo'] != 'piedra') || ($_POST['sabor'] != 'jamon' && $_POST['sabor'] != 'napo' && $_POST['sabor'] != 'muzza')) {
                                echo Response::JsendResponse("Fail", "Tipo o sabor no validos");
                            } else {
                                echo Gestion_Productos::RegistrarProducto($directorio_productos, $_POST);
                            }
                        } else {
                            echo Response::JsendResponse("Fail", "Debe ser encargado");
                        }
                        break;
                    case '/ventas':
                        $usuario = Gestion_Usuarios::getUser(getallheaders(), $key);
                        if (!Gestion_Usuarios::EsEncargado($usuario)) {
                            $pizza = Gestion_Productos::GetPizza($directorio_productos, $_POST['tipo'], $_POST['sabor']);
                            if($pizza != null){
                                $respuesta = Gestion_Productos::VenderProducto($directorio_productos, $pizza->tipo, $pizza->sabor);
                                if (json_decode($respuesta)->status == 'Success'){
                                //  {[{"email":"matias@gmail.com","tipo":"piedra","monto":"napo","sabor":"300","fecha":"05-05-20"}]
                                    $venta = new Venta($usuario->email, $pizza->tipo, $pizza->precio, $pizza->sabor, date("d-m-y"));
                                    Gestion_Productos::RegistrarVenta($directorio_ventas, $venta);
                                }
                            } else {
                                $respuesta = Response::JsendResponse("Fail", "No existe esa combinacion de pizza");
                            }
                            echo $respuesta;
                        } else {
                            echo Response::JsendResponse("Fail", "El usuario no es cliente para poder vender");
                        }
                        break;

                    default:
                        echo Response::JsendResponse("Error", "Endpoint invalido");
                        break;
                }
                break;
            case 'GET':
                switch ($_SERVER['PATH_INFO']) {
                    case '/pizzas':
                        $usuario = Gestion_Usuarios::getUser(getallheaders(), $key);
                        $pizzas_registradas = Gestion_Productos::ProductosRegistrados($directorio_productos);

                        if (Gestion_Usuarios::EsEncargado($usuario)) {
                            echo Response::JsendResponse("success", array("Productos" => $pizzas_registradas));
                        } else {
                            $pizzas_sin_stock = array();
                            foreach ($pizzas_registradas as $key => $pizza_leida) {
                                unset($pizza_leida->stock);
                                array_push($pizzas_sin_stock, $pizza_leida);
                            }
                            echo Response::JsendResponse("success", array("Productos" => $pizzas_sin_stock));
                        }
                        break;
                    case '/ventas':
                        //Decodifico el usuario
                        $usuario = Gestion_Usuarios::getUser(getallheaders(), $key);
                        //Y se lo envio a esta funcion, la misma ya se fija si es admin o no
                        echo Gestion_Archivos::VentasRealizadas($directorio_ventas, $usuario);
                        break;

                    default:
                        echo Response::JsendResponse("Error", "Tipo de solicitud no valida");
                        break;
                }
        }
    } else {
        echo Response::JsendResponse("Error", "No se encontro Endpoint");
    }
} else {
    echo Response::JsendResponse("Error", "Método nulo");
}
