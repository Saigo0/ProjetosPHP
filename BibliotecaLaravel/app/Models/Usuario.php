<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'login',
        'senha',
        'pessoa_id',
        'nivelAcesso',
    ];

    protected $hidden = [
        'senha',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function leitor()
    {
        return $this->hasOne(Leitor::class);
    }

    public function bibliotecario()
    {
        return $this->hasOne(Bibliotecario::class);
    }

    public function administrador(){
        return $this->hasOne(Administrador::class);
    }
}
