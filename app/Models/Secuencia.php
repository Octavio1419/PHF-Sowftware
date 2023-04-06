<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secuencia extends Model
{
    public $timestamps = false;
    use HasFactory;


    //NOS PERMITE PARA PODER MANDAR LOS DATOS DEL ID AL EDITAR, SIN ESTO NO PODEMOS MANDARLOS
    //3 HORAS CORRIGIENDO EL ERRRO Y SOLO NECESITABA ESTO PTM
    protected $primaryKey = 'idsecuencia';
}
