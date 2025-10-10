<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmprestimoLivro extends Model
{
    protected $table = 'emprestimo_livro';

    protected $fillable = [
        'emprestimo_id',
        'livro_id',
    ];

    public function emprestimo()
    {
        return $this->belongsTo(Emprestimo::class);
    }

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }
}
