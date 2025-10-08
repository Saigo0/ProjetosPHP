<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bibliotecario extends Model
{
    protected $table = 'bibliotecarios';

    protected $fillable = [
        'usuario_id',
        'registroCRB',
        'valorCRB',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
