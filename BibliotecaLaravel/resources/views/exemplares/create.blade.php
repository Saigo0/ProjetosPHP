@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    <h1>Teste</h1>
    <div class="container mt-5">
        <h1>Crie uma nova pessoa</h1>
        <hr>
        <form action="{{ route('exemplares-store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label for="nome">Código de exemplar:</label>
                    <input type="text" class="form-control" name="codigoExemplar" id="codigoExemplar" placeholder="Código do exemplar">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">ISBN do livro:</label>
                    <input type="email" class="form-control" name="livroISBN" id="livroISBN" placeholder="ISBN do livro">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" id="submit" placeholder="Nome da pessoa">
                </div>
            </div>
        </form>
    </div>


@endsection