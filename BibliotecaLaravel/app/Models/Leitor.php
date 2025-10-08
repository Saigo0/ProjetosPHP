<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leitor extends Model
{
    protected $table = 'leitores';

    protected $fillable = [
        'usuario_id',
        'pendente',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
