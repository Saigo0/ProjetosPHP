@extends('layouts.app')

@section('title', 'Edição')


@section('content')

    
        <header>
            <h1>Editar pessoa</h1>
        </header>
        
        <main>
            <form action="{{ route('pessoas-update', ['id'=>$pessoas->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{ $pessoas->nome }}" placeholder="Nome da pessoa">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $pessoas->email }}" placeholder="Email">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" value="{{ $pessoas->telefone }}" placeholder="Telefone">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" id="endereco" value="{{ $pessoas->endereco }}" placeholder="Endereço">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Atualizar" name="submit" id="submit">
                    </div>
                </div>
            </form>
        </main>
    
    <section><a href="{{ route('emprestimos-index') }}">Voltar</a></section>

@endsection