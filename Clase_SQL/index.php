<!-- Ejemplo de conexion con PDO
   
 - Instanciando una conexion a la base de datos -
 try {
    
    -Obligatorio-
    $consStir = 'mysql:host = localhost; dbname = PruebaDB';
    $user='root'; //User por defecto en el XAMP
    $pass='';  //Psswd por defecto en el XAMP

    $pdo = new PDO($consStr, $user, $pass);
    echo 'Conexion ok';
    $query = $pdo->prepare('SELECT * FROM alumnos'):;
    $query->execute();
    $resultado = $query->fetchAll(PDO::FETCH_BOTH);
    $resultado = $query->fetchAll(PDO::FETCH_CLASS, 'alumno');
    $msg = $resultado;
    --------------
 } catch (\Throwable $th) {
     $msg = th->getMessage().'</br>';
 }
   echo $msg;
 -->

 <?php
