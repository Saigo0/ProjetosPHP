@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    <div class="container mt-5">
        <h1>Realizar Empréstimo</h1>
        <hr>
        <form action="{{ route('emprestimos-store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="mb-3">
                    <label for="id_leitor" class="form-label">Leitor:</label>
                    <select name="leitor_id" id="leitor_id" class="form-select">
                        @foreach($leitores as $leitor)
                            @if ($leitor->pendente)
                                @continue
                            @endif
                            <option value="{{ $leitor->id }}">{{ $leitor->usuario->pessoa->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="mb-3">
                    <label for="id_livro" class="form-label">Livro:</label>
                    <select name="id_livro[]" id="id_livro" class="form-select" multiple>
                        @foreach($livros as $livro)
                            <option value="{{ $livro->id }}">{{ $livro->titulo }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Use Ctrl + clique para selecionar mais de um livro</small>
            </div>
            <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" id="submit" placeholder="Criar">
                </div>
        </form>
    </div>
@endsection