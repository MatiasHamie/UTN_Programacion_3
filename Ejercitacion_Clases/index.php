<?php
 /**
  * Metodos HTTP:
  * Get: Obtengo, en PostMan pongo en 
  *         -> Params -> key: nombre | value: Mario
  *          quedaria algo asi en la url
  *          localhost:8080/.../index.php?nombre=Mario
  *          $_GET es un array, donde dentro estan todas las variables
  *          con sus valores, entonces como es un array para acceder a nombre
  *          echo $_GET['nombre'];
  *          si le pifio al key, me dice que hay un index q no existe
  *          enviar siempre un booleano que diga todo ok junto con los datos
  * Post: Crear, usamos x-www-form-urlencoded o form-data en el PostMan
  * Put: Modificar
  * Delete: Borrar
  */
?>