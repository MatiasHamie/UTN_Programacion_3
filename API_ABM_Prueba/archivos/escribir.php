<?php

    /**
     * Este código se encarga de escribir un objeto en un archivo
     * utilizando una funcion estática
     */

    class Escribir{
        public static function EscribirObjetoTxt($filePath_Recibido,$obj_Recibido){
            $obj_serialized = serialize($obj_Recibido);
            $file_pointer = fopen($filePath_Recibido, "a");
            fwrite($file_pointer,$obj_serialized . "<br>");
            fclose($file_pointer);
        }
    }