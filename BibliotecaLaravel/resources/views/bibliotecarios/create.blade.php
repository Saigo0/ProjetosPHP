@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    <h1>Teste</h1>
    <div class="container mt-5">
        <h1>Crie um novo bibliotecário</h1>
        <hr>
        <form action="{{ route('bibliotecarios-store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da pessoa">
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
                    <label for="registroCRB">RegistroCRB:</label>
                    <input type="text" class="form-control" name="registroCRB" id="registroCRB" placeholder="RegistroCRB">
                </div>
                <br>
                <div class="form-group">
                    <label for="valorCRB">ValorCRB:</label>
                    <input type="text" class="form-control" name="endereco" id="endereco" placeholder="ValorCRB">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" id="submit" placeholder="Criar">
                </div>
            </div>
        </form>
    </div>


@endsection