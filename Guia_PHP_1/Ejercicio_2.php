<?php
    /*  Aplicación No 2 (Mostrar fecha y estación)
        Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
        distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
        año es. Utilizar una estructura selectiva múltiple.
     */

     $dia = date("d");
     $mes = date("m");
     $anio = date("Y");

     $estacion = "";

     switch ($mes) {
        case 4:
        case 5:
        case 3:
            if ($dia >= 21) {
                $estacion = "Otoño";
            }
            break;
        case 7:
        case 8:
        case 6:
            if ($dia >= 21) {
                $estacion = "Invierno";
            }
            break;
        case 9:
            if ($dia >= 21) {
                $estacion = "Primavera";
            }
            break;
        case 1:
        case 2:
        case 12:
            if ($dia >= 21) {
                $estacion = "Verano";
            }
            break;
         default:
             break;
     }

    echo "Hoy es $dia/$mes/$anio<br> y la estacion del año es $estacion";

?>