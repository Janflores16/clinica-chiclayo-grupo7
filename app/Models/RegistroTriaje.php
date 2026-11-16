<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroTriaje extends Model
{
    protected $table = 'registro_triajes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'paciente_dni',
        'temperatura',
        'frecuencia_cardiaca',
        'mensaje_alerta'
    ];
}
