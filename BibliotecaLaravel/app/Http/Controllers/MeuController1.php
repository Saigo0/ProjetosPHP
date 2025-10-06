<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeuController1 extends Controller
{
    public function metodo1(){
        $nome = 'nome';
        $id = 1;
        return view('telaspadrao.index', ['nome' => $nome, 'id' => $id]);
    }
}
