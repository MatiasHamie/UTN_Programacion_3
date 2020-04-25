<?php

class Archivos
{
    public $archivo_abierto;
    public $caracteres_escritos;
    public $info_leida;
    public $path_recibido;
    public $array_de_Personas;
    public $fileSize;

    public function __construct($path_recibido)
    {
        $this->path_recibido = $path_recibido;
    }

    public function Guardar_Persona($persona_recibida)
    {
        if (isset($persona_recibida)) {
            //Esta función lee las personas guardadas
            $this->array_de_Personas = self::Leer_Personas($this->fileSize, $this->path_recibido, $this->archivo_abierto, $this->info_leida);

            //Agrego a la persona recibida al array
            array_push($this->array_de_Personas, $persona_recibida);

            //Escribo el archivo
            $this->archivo_abierto = fopen($this->path_recibido, 'w');
            $this->caracteres_escritos = fwrite($this->archivo_abierto, serialize($this->array_de_Personas));
            $retorno = ($this->caracteres_escritos > 0) ? true : false;
            fclose($this->archivo_abierto);
            return $retorno;
        } else {
            return false;
        }
    }

    public static function Leer_Personas($fileSize, $path_recibido, $archivo_abierto, $info_leida)
    {
        if (filesize($path_recibido) < 1) {
            $fileSize = 20;
        } else {
            $fileSize = filesize($path_recibido);
        }

        //Leo el archivo y me guardo la info
        $archivo_abierto = fopen($path_recibido, 'r');
        $info_leida = fread($archivo_abierto, $fileSize);
        fclose($archivo_abierto);

        if ($info_leida == '') {
            //Si no leyó a nadie porque es la primera vez, inicializo un array vacio
            $array_de_Personas = array();
        } else {
            //Deserializo los objetos
            $array_de_Personas = unserialize($info_leida);
        }

        return $array_de_Personas;
    }

    public function VerUsuarioCreado($email, $clave)
    {
        $this->array_de_Personas = self::Leer_Personas($this->fileSize, $this->path_recibido, $this->archivo_abierto, $this->info_leida);

        foreach ($this->array_de_Personas as $indice => $persona) {
            // var_dump($persona);
            if($persona->email == $email){
                if($persona->clave == $clave){
                    return $persona;
                }
            }
        }

        return null;
    }   
    
    public function MostrarUsuarios($usuarioLogueado)
    {
        $this->array_de_Personas = self::Leer_Personas($this->fileSize, $this->path_recibido, $this->archivo_abierto, $this->info_leida);
        $personasRetornadas = array();

        if($usuarioLogueado->tipo == 'admin'){
            $personasRetornadas = $this->array_de_Personas;
        } else {
            foreach ($this->array_de_Personas as $indice => $persona) {
                if ($persona->tipo == 'user') {
                    array_push($personasRetornadas,$persona);
                }
            }
        }

        return $personasRetornadas;
    }
}
