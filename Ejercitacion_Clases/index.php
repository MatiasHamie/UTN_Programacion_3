<?php
 /**
  * Metodos HTTP:
  * Get: Obtengo, en PostMan pongo en 
  *     -> Params -> key: nombre | value: Mario
  *     quedaria algo asi en la url
  *     localhost:8080/.../index.php?nombre=Mario
  *     $_GET es un array, donde dentro estan todas las variables
  *     con sus valores, entonces como es un array para acceder a nombre
  *     echo $_GET['nombre'];
  *     si le pifio al key, me dice que hay un index q no existe
  *     enviar siempre un booleano que diga todo ok junto con los datos
  * Post: Crear, usamos x-www-form-urlencoded o form-data en el PostMan
  * Put: Modificar
  * Delete: Borrar
  */

  /**
   * Comenzamos incluyendo las librerias
   * que vamos a usar con require_once
   */

    require_once __DIR__ . "/clases/persona.php";

   /**
    * Ahora tenemos que ir desglosando el request
    * que nos llega desde el FrontEnd
    * Para eso, usamos el $_SERVER, y como es un array
    * de datos que nos da del servidor desde donde
    * se esta enviando la request, accedemos
    * como un array
    */

    $server_info = $_SERVER;
    $request_path_destino = $server_info['PATH_INFO'] ?? '';
    $request_method = $server_info['REQUEST_METHOD'];


    if (!($request_path_destino == '')) {
      if ($request_method == 'POST') {
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $persona = new Persona($nombre, $edad);
        $persona->Escribir("./clases/persona.json",$persona);
      }
    }
    
?>