<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $table = 'emprestimos';

    protected $fillable = [
        'leitor_id',
        'dataEmprestimo',
        'dataDevolucao',
        'status',
    ];

    public function leitor()
    {
        return $this->belongsTo(Leitor::class);
    } 

    public function emprestimo_livro()
    {
        return $this->hasOne(EmprestimoLivro::class);
    }

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'emprestimo_livro', 'emprestimo_id', 'livro_id')
                    ->withPivot('dataDevolucao', 'status');
    }
}
