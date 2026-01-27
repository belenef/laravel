<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    protected $table = 'poliza';
    protected $fillable = ['vehiculo_id', 'tipo_poliza', 'importe', 'fecha_inicio', 'fecha_renovacion'];
    public $timestamps = true;

    public function vehiculo()
    {
        return $this->belongsTo(Examen::class, 'vehiculo_id');
    }
}
