<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule; //Se agrega a ano despues

require __DIR__ . '/vendor/autoload.php';
require './config/capsule.php';// Se agrega a mano despues
require './models/alumnos.php';


$app = AppFactory::create();
$app->setBasePath('/UTN_Programacion_3/API_ORM');//Esto se tiene que agregar a mano

$app->get('/orm', function (Request $request, Response $response, $args) {
    $alumno = Alumno::All();
    $rta = json_encode($alumno);
    $response->getBody()->write($rta);
    return $response;
});

// Me traigo solamente el legajo 1234
// $app->get('/', function (Request $request, Response $response, $args) {
//     // hago un get a la base de datos (ya configurada en capsule) tabla alumnos
//     $alumnos = Capsule::table('alumnos')
//     // ->where('legajo','1234')//Dame el alumn con legajo 1234
//     ->where('legajo','>','1234')//Dame el/los alumnos con legajo mayor a 1234
//     ->where('localidad','1')//para hacer un and agregue este where y ya es un and!
// Si quiero hacer una or es ->where(blabla)->orWhere(blabla) y listo
//     // ->whereRaw()//Aca escribmos en lenguaje SQL
//     ->get();//Devuelve un array
//     // ->first();//Devuelve el primero como objeto no array
//     // parseo a json los alumnos q recibo
//     $rta = json_encode($alumnos);
//     //Los muestro
//     $response->getBody()->write($rta);
//     return $response;
// });

// $app->get('/', function (Request $request, Response $response, $args) {
//     // hago un get a la base de datos (ya configurada en capsule) tabla alumnos
//     $alumnos = Capsule::table('alumnos')
//     ->select('alumno','legajo')//Restringimos para que solamente nos traiga alumno y legajo
//     ->get();
//     // parseo a json los alumnos q recibo
//     $rta = json_encode($alumnos);
//     //Los muestro
//     $response->getBody()->write($rta);
//     return $response;
// });

//- JOINS -
// $app->get('/join', function (Request $request, Response $response, $args) {
//     // hago un get a la base de datos (ya configurada en capsule) tabla alumnos
//     $alumnos = Capsule::table('alumnos')
//     ->join('localidades','localidades.id','alumnos.localidad')
//     ->join('cuatrimestres','cuatrimestres.id','alumnos.cuatrimestre')
//     ->select('alumnos.id','legajo','alumno','localidades.localidad','cuatrimestres.nombre')//aclarar de que tabla es el id, ojo con eso
//     ->get();
//     // parseo a json los alumnos q recibo
//     $rta = json_encode($alumnos);
//     //Los muestro
//     $response->getBody()->write($rta);
//     return $response;
// });

// $app->get('/agg', function (Request $request, Response $response, $args) {
//     // hago un get a la base de datos (ya configurada en capsule) tabla alumnos
//     $alumnos = Capsule::table('alumnos')
//     ->count();//Trae la cantidad de registros que tiene la tabla (solo el numero)
//     // ->avg('legajo');//Promedio de legajos avg = average
//     // ->max('legajo');//legajo mas grande (idem ->min())
//     // parseo a json los alumnos q recibo
//     $rta = json_encode($alumnos);
//     //Los muestro
//     $response->getBody()->write($rta);
//     return $response;
// });
// - POST -
// $app->post('/', function (Request $request, Response $response, $args) {
//     $alumnos = Capsule::table('alumnos')
//     // ->insert([//Devuelve true o false depende de si pudo o no insertar
//     //     'alumno' => 'eloquent',
//     //     'legajo' => 1580,
//     //     'localidad' => 1,
//     //     'cuatrimestre' => 2
//     // ]);
//     ->insertGetId([//Devuelve true o false depende de si pudo o no insertar
//         'alumno' => 'eloquent2',
//         'legajo' => 1581,
//         'localidad' => 1,
//         'cuatrimestre' => 2
//     ]);
//     $rta = json_encode($alumnos);
//     //Los muestro
//     $response->getBody()->write($rta);
//     return $response;
// });

// $app->post('/', function (Request $request, Response $response, $args) {
//     $alumnos = Capsule::table('alumnos')
//     ->where('legajo', '1581')
//     // ->where('legajo', '>', '1581') //Afecta los legajo mayores a 1581
//     ->update([//Devuelve cantidad de filas afectadas
//         'alumno' => 'eloquent99',
//     ]);
//     $rta = json_encode($alumnos);
//     //Los muestro
//     $response->getBody()->write($rta);
//     return $response;
// });
// $app->post('/incrementar', function (Request $request, Response $response, $args) {
//     $alumnos = Capsule::table('alumnos')
//     ->where('legajo', '1235') //Afecta los legajo mayores a 1581
//     ->increment('localidad');
//     $rta = json_encode($alumnos);
//     //Los muestro
//     $response->getBody()->write($rta);
//     return $response;
// });

// $app->post('/delete', function (Request $request, Response $response, $args) {
//     $alumnos = Capsule::table('alumnos')
//     ->where('legajo', '1234') //Afecta los legajo mayores a 1581
//     ->delete();
//     $rta = json_encode($alumnos);
//     //Los muestro
//     $response->getBody()->write($rta);
//     return $response;
// });

$app->run();