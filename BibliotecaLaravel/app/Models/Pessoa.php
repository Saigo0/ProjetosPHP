<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco',
    ];

    public function usuario()
    {
        return $this->hasOne(Usuario::class);
    }
}
