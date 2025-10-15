@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    
        <header>
            <h1>Listagem de Livros</h1>
        </header>
        
        <main>
            <a href="{{ route('livros-create') }}" class="btn btn-primary mb-3">Criar novo livro</a>
                
            
                <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Editora</th>
                    <th scope="col">Páginas</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livros as $livro)
                    <tr>
                        <th scope="row">{{ $livro->id }}</th>
                        <td>{{ $livro->titulo }}</td>
                        <td>{{ $livro->autor }}</td>
                        <td>{{ $livro->editora }}</td>
                        <td>{{ $livro->numPaginas }}</td>
                        <td>@if ($livro->estaEmprestado) <span style="color: red">Emprestado</span> @else <span style="color: green">Disponível</span>
                            
                        @endif</td>
                        <td>
                            <a href="{{ route('livros-edit', ['id'=>$livro->id]) }}" class="btn btn-primary">
                                Editar
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg>
                            </a>
                            <a href="#" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir?')) document.getElementById('delete-{{ $livro->id }}').submit();">
                                        Deletar
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1, etc..."/>
                                        </svg>
                                </a>

                                <form id = "delete-{{ $livro->id }}" action="{{ route('livros-destroy', $livro->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
                </table>
        </main>

    @php
    use App\Models\Usuario;
        $usuario = Usuario::find(session('usuario_id'));
        $rotaRetorno = $usuario->nivelAcesso === 'ADMINISTRADOR' ? route('administrador-dashboard') : route('bibliotecario-dashboard');
    @endphp

    <section><a href="{{ $rotaRetorno }}" class="btn btn-secondary">Voltar à tela principal</a></section>

    

@endsection