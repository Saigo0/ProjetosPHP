<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livros';

    protected $fillable = [
        'titulo',
        'autor',
        'isbn',
        'anoEdicao',
        'editora',
        'numPaginas',
        'localEdicao',
    ];

    public function emprestimos()
    {
        return $this->belongsTo(EmprestimoLivro::class);
    }
}
