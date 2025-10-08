<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class MeuController1 extends Controller
{
    public function metodo1(){
        $nome = 'nome';
        $id = 1;
        return view('telaspadrao.index', ['nome' => $nome, 'id' => $id]);
    }

    public function create(){
        return view('telaspadrao.create');
    }

    public function returnAll(){
        $pessoas = Pessoa::all();
        return view('telaspadrao.index', ['pessoas' => $pessoas]);
    }
    
    public function store(Request $request){
        $validated = $request->validate([
            'nome' => 'required|max:55',
            'email' => 'required|email|max:100',
            'endereco' => 'required|max:255',
            'telefone' => 'required|max:20',
        ]);

        Pessoa::create($validated);

        return redirect()->route('pessoas-index');
    }

    public function edit($id){
        $pessoas = Pessoa::where('id', $id)->first();
        if(!empty($pessoas)){
            return view('telaspadrao.edit', ['pessoas' => $pessoas]);
        } else
        return redirect()->route('pessoas-index');
    }

    public function update(Request $request){
        $validated = $request->validate([
            'id' => 'required|integer',
            'nome' => 'required|max:55',
            'email' => 'required|email|max:100',
            'endereco' => 'required|max:255',
            'telefone' => 'required|max:20',
        ]);

        $pessoas = Pessoa::where('id', $request->id)->first();
        if(!empty($pessoas)){
            $pessoas->update($validated);
        }

        return redirect()->route('pessoas-index');
    }

    public function destroy($id){
        $pessoas = Pessoa::where('id', $id)->first();
        if(!empty($pessoas)){
            $pessoas->delete();
        }
        return redirect()->route('pessoas-index');
    }
}
