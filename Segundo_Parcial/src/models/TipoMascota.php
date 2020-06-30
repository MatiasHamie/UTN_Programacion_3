<?php
namespace App\Models;

class TipoMascota extends \Illuminate\Database\Eloquent\Model
{
    // Esto es usado por el controller para comunicarse con la ddbb
    // Si no tengo creadas las tablas de creados a y bla bla, tengo q poner
    public $timestamps = false;
    protected $table = 'tipo_mascota';
}
