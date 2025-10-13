@extends('layouts.app')

@section('title', 'Edição')


@section('content')
    <div class="container mt-5">
        <h1>Editar livro</h1>
        <hr>
        <form action="{{ route('livros-update', ['id'=>$livros->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $livros->titulo }}" placeholder="Título do livro">
                </div>
                <br>
                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" name="isbn" id="isbn" value="{{ $livros->isbn }}" placeholder="ISBN">
                </div>
                <br>
                <div class="form-group">
                    <label for="autor">Autor:</label>
                    <input type="text" class="form-control" name="autor" id="autor" value="{{ $livros->autor }}" placeholder="Autor">
                </div>
                <br>
                <div class="form-group">
                    <label for="editora">Editora:</label>
                    <input type="text" class="form-control" name="editora" id="editora" value="{{ $livros->editora }}" placeholder="Editora">
                </div>
                <br>
                <div class="form-group">
                    <label for="numPaginas">Páginas:</label>
                    <input type="text" class="form-control" name="numPaginas" id="numPaginas" value="{{ $livros->numPaginas }}" placeholder="Número de páginas">
                </div>
                <br>
                <div class="form-group">
                    <label for="anoEdicao">Ano de edição:</label>
                    <input type="text" class="form-control" name="anoEdicao" id="anoEdicao" value="{{ $livros->anoEdicao }}" placeholder="Ano de edição">
                </div>
                <br>
                <div class="form-group">
                    <label for="localEdicao">Local de edição:</label>
                    <input type="text" class="form-control" name="localEdicao" id="localEdicao" value="{{ $livros->localEdicao }}" placeholder="Local de edição">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Atualizar" name="submit" id="submit">
                </div>
            </div>
        </form>
    </div>


@endsection