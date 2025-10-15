@extends('layouts.app')

@section('title', 'Edição')


@section('content')
    
        <header>
            <h1>Editar bibliotecário</h1>
        </header>
        
        <main>
            <form action="{{ route('bibliotecarios-update', ['id'=>$bibliotecarios->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{ $bibliotecarios->usuario->pessoa->nome }}" placeholder="Nome da pessoa">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $bibliotecarios->usuario->pessoa->email }}" placeholder="Email">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" value="{{ $bibliotecarios->usuario->pessoa->telefone }}" placeholder="Telefone">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" id="endereco" value="{{ $bibliotecarios->usuario->pessoa->endereco }}" placeholder="Endereço">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="login">Login:</label>
                        <input type="text" class="form-control" name="login" id="login" value="{{ $bibliotecarios->usuario->login }}" placeholder="Login">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="registroCRB">RegistroCRB:</label>
                        <input type="text" class="form-control" name="registroCRB" id="registroCRB" value="{{ $bibliotecarios->registroCRB }}" placeholder="RegistroCRB">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="valorCRB">ValorCRB:</label>
                        <input type="text" class="form-control" name="valorCRB" id="valorCRB" value="{{ $bibliotecarios->valorCRB }}" placeholder="ValorCRB">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Atualizar" name="submit" id="submit">
                    </div>
                </div>
            </form>
        </main>
    

    <section><a href="{{ route('bibliotecarios-index') }}">Voltar</a></section>
@endsection