<?php

var_dump($_FILES['archivo']);

if ($_FILES['archivo']['size'] > 10000) {
    echo "error de size";
}

$tmp_name = $_FILES['archivo']['tmp_name'];

$name = $_FILES['archivo']['name'];

$nombre = $_POST['legajo'] . '-' . time() . '.' . explode('.', $name)[1];

$folder = 'images/';

$origen = 'images/C650-SPORT.jpg';
$destino = 'images_backup/C650-SPORT.jpg';
if (copy($origen, $destino))
    unlink($origen);
// echo move_uploaded_file($tmp_name, $folder . $nombre);