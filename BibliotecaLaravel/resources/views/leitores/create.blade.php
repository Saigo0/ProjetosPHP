@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    <div class="container mt-5">
        <h1>Crie um novo leitor</h1>
        <hr>
        <form action="{{ route('leitores-store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do leitor">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <br>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone">
                </div>
                <br>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço">
                </div>
                <br>
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" class="form-control" name="login" id="login" placeholder="Login">
                </div>
                <div>
                <br>
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" id="submit" placeholder="Enviar">
                </div>
            </div>
        </form>
    </div>


@endsection