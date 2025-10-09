@extends('layouts.app')

@section('title', 'Edição')


@section('content')
    <h1>Teste</h1>
    <div class="container mt-5">
        <h1>Editar pessoa</h1>
        <hr>
        <form action="{{ route('leitores-update', ['id'=>$leitores->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" value="{{ $leitores->nome }}" placeholder="Nome do leitor">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $leitores->email }}" placeholder="Email">
                </div>
                <br>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" value="{{ $leitores->telefone }}" placeholder="Telefone">
                </div>
                <br>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" name="endereco" id="endereco" value="{{ $leitores->endereco }}" placeholder="Endereço">
                </div>
                <br>
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" class="form-control" name="login" id="login" value="{{ $leitores->login }}" placeholder="Login">
                </div>
                <br>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="text" class="form-control" name="senha" id="senha" value="{{ $leitores->senha }}" placeholder="Senha">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Atualizar" name="submit" id="submit">
                </div>
            </div>
        </form>
    </div>


@endsection