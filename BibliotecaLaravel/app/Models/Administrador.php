<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';

    protected $fillable = [
        'usuario_id',
        'superAdmin',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
