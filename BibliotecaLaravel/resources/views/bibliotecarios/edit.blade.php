@extends('layouts.app')

@section('title', 'Edição')


@section('content')
    <h1>Teste</h1>
    <div class="container mt-5">
        <h1>Editar pessoa</h1>
        <hr>
        <form action="{{ route('bibliotecarios-update', ['id'=>$bilbiotecarios->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" value="{{ $bibliotecarios->nome }}" placeholder="Nome da pessoa">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $bibliotecarios->email }}" placeholder="Email">
                </div>
                <br>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" value="{{ $bibliotecarios->telefone }}" placeholder="Telefone">
                </div>
                <br>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" name="endereco" id="endereco" value="{{ $bibliotecarios->endereco }}" placeholder="Endereço">
                </div>
                <br>
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" class="form-control" name="login" id="login" value="{{ $bibliotecarios->endereco }}" placeholder="Endereço">
                </div>
                <br>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="text" class="form-control" name="senha" id="senha" value="{{ $bibliotecarios->endereco }}" placeholder="Endereço">
                </div>
                <br>
                <div class="form-group">
                    <label for="registroCRB">RegistroCRB:</label>
                    <input type="text" class="form-control" name="registroCRB" id="registroCRB" value="{{ $bibliotecarios->endereco }}" placeholder="RegistroCRB">
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
    </div>


@endsection