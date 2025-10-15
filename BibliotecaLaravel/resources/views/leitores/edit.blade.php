@extends('layouts.app')

@section('title', 'Edição')


@section('content')
    
        <header>
            <h1>Editar Leitor</h1>
        </header>
        
        <main>
            <form action="{{ route('leitores-update', ['id'=>$leitores->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{ $leitores->usuario->pessoa->nome }}" placeholder="Nome do leitor">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $leitores->usuario->pessoa->email }}" placeholder="Email">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" value="{{ $leitores->usuario->pessoa->telefone }}" placeholder="Telefone">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" id="endereco" value="{{ $leitores->usuario->pessoa->endereco }}" placeholder="Endereço">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="pendente">Status:</label>
                        <select name="pendente" id="pendente" class="form-control">
                            <option value="1" {{ $leitores->pendente == 1 ? 'selected' : '' }}>Pendente</option>
                            <option value="0" {{ $leitores->pendente == 0 ? 'selected' : '' }}>Não pendente</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Atualizar" name="submit" id="submit">
                    </div>
                </div>
            </form>
        </main>
    

    <section><a href="{{ route('leitores-index') }}">Voltar</a></section>
@endsection