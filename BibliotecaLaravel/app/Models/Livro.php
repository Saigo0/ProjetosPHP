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
        return $this->belongsToMany(Emprestimo::class, 'emprestimo_livro', 'livro_id', 'emprestimo_id');
    }

    public function scopeDisponiveis($query)
    {
        return $query->whereNotExists(function ($sub) {
        $sub->from('emprestimo_livro')
            ->join('emprestimos', 'emprestimos.id', '=', 'emprestimo_livro.emprestimo_id')
            ->whereColumn('livros.id', 'emprestimo_livro.livro_id')
            ->whereNull('emprestimos.dataDevolucao');
        });
    }
}
