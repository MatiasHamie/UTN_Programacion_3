<?php

class Datos {

    public static function guardar ($archivo, $datos) {
        $file = fopen($archivo, 'a');

        $rta = fwrite($file, $datos);

        fclose($file);

        return $rta;

    }

    public static function guardarJSON($archivo, $objeto)
    {
        // LEEMOS
        $file = fopen($archivo, 'r');

        $arrayString = fread($file, filesize($archivo));

        $arrayJSON = json_decode($arrayString);

        fclose($file);

        array_push($arrayJSON, $objeto);

        // ESCRIBIMOS
        $file = fopen($archivo, 'w');

        $rta = fwrite($file, json_encode($arrayJSON));

        fclose($file);

        return $rta;
    }


    static public function leerJSON($archivo) {
        $file = fopen($archivo, 'r');

        $arrayString = fread($file, filesize($archivo));

        $arrayJSON = json_decode($arrayString);

        fclose($file);

        return $arrayJSON;
    }

    public static function leerTodo($archivo) {
        $file = fopen($archivo, 'r');

        $lista = array();

        while (!feof($file)) {
            # code...
            $linea = fgets($file);

            $explode = explode('@', $linea);
            
            if (count($explode)  > 1) {
                array_push($lista, $explode);
            }
        }

        fclose($file);
        
        return $lista;
    }
}