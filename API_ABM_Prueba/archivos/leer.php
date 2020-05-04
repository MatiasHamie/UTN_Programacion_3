<?php

    /**
     * Este código se encarga de escribir un objeto en un archivo
     * utilizando una funcion estática
     */
    class Leer{
        public static function LeerObjetoTxt($filePath_Recibido){
            $fp = fopen($filePath_Recibido,"r");
            $objSerializado = fread($fp,filesize($filePath_Recibido));
            $arrayDeObjetos = explode("<br>",$objSerializado);
            fclose($fp);

            return $arrayDeObjetos;
        }
    }