@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    
        <header>
            <h1>Crie um novo livro</h1>
        </header>
        
        <main>
            <form action="{{ route('livros-store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo do livro">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="isbn">ISBN:</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="autor">Autor:</label>
                        <input type="text" class="form-control" name="autor" id="autor" placeholder="Autor">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="Editora">Editora:</label>
                        <input type="text" class="form-control" name="editora" id="editora" placeholder="Editora">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="numPaginas">Páginas:</label>
                        <input type="text" class="form-control" name="numPaginas" id="numPaginas" placeholder="Número de páginas">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="anoEdicao">Ano da edição:</label>
                        <input type="text" class="form-control" name="anoEdicao" id="anoEdicao" placeholder="Ano de edição">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="localEdicao">Local da edição:</label>
                        <input type="text" class="form-control" name="localEdicao" id="localEdicao" placeholder="Local de edição">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" id="submit" placeholder="Enviar">
                    </div>
                </div>
            </form>
        </main>
    

    <section><a href="{{ route('livros-index') }}">Voltar</a></section>

@endsection