<?php
/*--  Trabajo Práctico Nro 1 de la materia LABORATORIO 3 --

Consigna: Crear una aplicación con composer que utilice una dependencia.
Se debe utilizar POO, herencia, al menos 3 clases y una interfaz, métodos de clase y de instancia.
Se debe poder obtener los países por continente, sub región, por idioma o capital y los detalles completos de cada país.
Crear un repositorio en github para guardar el código.

El paquete de países que vimos en clase es namnv609/php-rest-countries.

Se puede utilizar cualquier paquete si se respeta la consigna.

Cuando creen el repositorio completar el formulario de esta tarea.*/

//Directorios
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/clases/pais.php';
require_once __DIR__ . '/clases/paisConFronteras.php';
require_once __DIR__ . '/clases/paisConCapital.php';

use NNV\RestCountries;
$restCountries = new RestCountries;

//-- Declaracion de objetos
//Clase base
$pais = new Pais($restCountries->byName("Spain"));

//Clase Hereda de Clase Base
$paisConFronteras = new PaisConFronteras($restCountries->byName("Argentina"));

//Clase Hereda de Clase Hijo
$paisConCapital = new PaisConCapital($restCountries->byName("Germany"));

echo "--- Trabajo Practica Nro. 3 de la materia Programacion 3 ---<br>";
echo "<br><br>";

echo "--- Muestro Pais (Implementa interfaz) ---<br>";
echo $pais->getInfo();
echo "<br><br>";

echo "--- Muestro Pais con sus fronteras (Implementa interfaz y Hereda de Pais) ---<br>";
echo $paisConFronteras->getInfo();
echo "<br><br>";

echo "--- Muestro Pais con su poblacion (Implementa interfaz y Hereda de Pais Con Fronteras) ---<br>";
echo $paisConCapital->getInfo();