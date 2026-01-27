<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $table = 'vehiculo';
    protected $fillable = ['marca', 'modelo', 'anio_fab', 'matricula', 'poster'];
    public $timestamps = true;
}
