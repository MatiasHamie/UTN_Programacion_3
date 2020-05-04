<?php
class Persona
{
    public $nombre;
    public $edad;

    //Archivos
    protected $filePath;
    protected $filePointer;
    protected $fileArrayPersonas = [];
    protected $fileJson;
    protected $fileCaracteresEscritos;
    protected $fileSize;

    public function __construct($nombre, $edad)
    {
        $this->nombre = $nombre ?? '';
        $this->edad = $edad ?? '';
    }

    public function Escribir($filePath, $personaRecibida)
    {
        /*
         * Cuando tenemos que escribir un archivo ".json"
         * tenemos que ver si hay algo previamente guardado
         */

        // -> primero lo tenemos que leer

        try {
            if (!(isset($filePath))) {
                throw new Exception('No se recibió path al archivo');
                echo "entro";
            } else if (!(file_exists($filePath))) {
                throw new Exception('El directorio no existe');
            } else {
                $this->filePath = $filePath;
            }

            // Leo el archivo
            $this->filePointer = fopen($this->filePath, 'r');

            if (filesize($this->filePath) < 1){
                $this->fileSize = 5;
            }
            else{
                $this->fileSize = filesize($this->filePath);
            }
            $this->fileJson = fread($this->filePointer, $this->fileSize);
            $this->fileArrayPersonas = json_decode($this->fileJson) ?? array();
            fclose($this->filePointer);

            //Modifico el array
            array_push($this->fileArrayPersonas,$personaRecibida);

            // //Escribo el archivo
            $this->filePointer = fopen($this->filePath, 'w');
            $this->fileCaracteresEscritos = fwrite($this->filePointer, json_encode($this->fileArrayPersonas));
            fclose($this->filePointer);

            return $this->fileCaracteresEscritos;
        } catch (Exception $e) {
            return $e->getMessage() . "<br>";
        }



        /* 
         * -> segundo decodificar ese .json para convertirlo 
         * a un array de objetos
         * 
         * -> tercero cerramos el archivo
         * 
         * -> cuarto hacemos llamamos a la funcion 
         * array_push($array que leimos, $personas que nos mandaron lo pisamos)
         */
    }
}
