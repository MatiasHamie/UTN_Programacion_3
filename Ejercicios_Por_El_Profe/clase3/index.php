<?php
require_once './persona.php';
require_once './response.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '';
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO']  : '';

$response = new Response();

switch ($path) {
    case '/persona':
        switch ($method) {

            case 'GET': // Mostrar recurso
                $legajo = $_GET['legajo'] ?? 0;

                if ($legajo == 0) {
                    $rta = Persona::find();
                } else {
                    $rta = Persona::find($legajo);
                }

                $response->data = $rta;

                echo json_encode($response);
                break;
            case 'POST': // Guardar recursos
                
                $nombre = $_POST['nombre'] ?? null;
                $apellido = $_POST['apellido'] ?? null;
                $legajo = $_POST['legajo'] ?? null;
                
                if (isset($nombre) && isset($apellido) && isset($legajo)) {
                    
                    $persona = new Persona($nombre, $apellido, $legajo);

                    $rta = $persona->save();

                    $response->data = $rta;

                    echo json_encode($response);
                } else {
                    
                    $response->data = 'Faltan datos';
                    $response->status = 'fail';

                    echo json_encode($response);
                }

                break;
            case 'DELETE':
                echo 'DELETE';
                break;
            default:
                echo "Metodo no soportado";
        }
        break;
    case '/alumno':

        break;
}
