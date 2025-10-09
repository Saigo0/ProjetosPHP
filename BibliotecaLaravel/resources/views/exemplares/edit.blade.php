@extends('layouts.app')

@section('title', 'Edição')


@section('content')
    <h1>Teste</h1>
    <div class="container mt-5">
        <h1>Editar pessoa</h1>
        <hr>
        <form action="{{ route('exemplares-update', ['id'=>$pessoas->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-group">
                    <label for="nome">Código do exemplar:</label>
                    <input type="text" class="form-control" name="nome" id="nome" value="{{ $exemplares->nome }}" placeholder="Nome da pessoa">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">ISBN do livro:</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $exemplares->email }}" placeholder="Email">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Atualizar" name="submit" id="submit">
                </div>
            </div>
        </form>
    </div>


@endsection