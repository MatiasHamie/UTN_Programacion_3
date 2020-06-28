<?php
// require_once __DIR__ . '/../src/Models/alumno.php';

// Para que funcione esto "use App\Models\Alumno;"
// hay q ejecutar en el composer 
// un comando para que regenere el autoload
// esto con classmap composer dump-autoload CADA VEZ que agregue algo al namespace
// esto con psr-4 composer dumpautoload -o
//Agrege el alumno lo hago, utn/inscripcion, tamb le doy
require_once __DIR__ . '/../vendor/autoload.php';
// use App\Models\Alumno;
// use App\Models\UTN\Inscripcion;

// $alumno1 = new Alumno();
// $alumno1->Saludar();

// $inscripcion1 = new Inscripcion();
// $inscripcion1->Saludar();

// Bootstrap me devuelve una instancia, asi q lo pongo entre ()
(require __DIR__ . '/../config/bootstrap.php')->run();