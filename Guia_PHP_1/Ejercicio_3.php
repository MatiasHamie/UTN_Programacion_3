<?php
    /*Aplicación No 3 (Obtener el valor del medio)
    Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
    el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
    variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido.
    Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
    Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”*/

    $a = 14;
    $b = 15;
    $c = 9;
    $valorMedio = "";

    if(($b < $a && $a < $c) || ($c < $a && $a < $b)){
        $valorMedio = $a;
    }
    elseif (($a < $b && $b < $c) || ($c < $b && $b < $a)) {
        $valorMedio = $c;
    }
    else{
        $valorMedio = $c;
    }

    echo "Valor medio = $valorMedio";

?>