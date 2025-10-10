@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    <div class="container mt-5">
        <h1>Listagem de Bibliotecários</h1>
        <hr>
        <a href="{{ route('bibliotecarios-create') }}" class="btn btn-primary mb-3">Criar novo bibliotecario</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bibliotecarios as $bibliotecario)
                <tr>
                    <th scope="row">{{ $bibliotecario->id }}</th>
                    <td>{{ $bibliotecario->usuario->pessoa->nome }}</td>
                    <td>{{ $bibliotecario->usuario->pessoa->email }}</td>
                    <td>{{ $bibliotecario->usuario->pessoa->telefone }}</td>
                    <td>{{ $bibliotecario->usuario->pessoa->endereco }}</td>
                    <th class="d-flex">
                    <a href="{{ route('bibliotecarios-edit', ['id'=>$bibliotecario->id]) }}" class="btn btn-primary">
                         Editar
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg>
                    </a>
                    <form action="{{ route('bibliotecarios-destroy', ['id'=>$bibliotecario->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Deletar
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1, etc..."/>
                            </svg>
                        </button> 
                    </form>
                </th>
                </tr>
            @endforeach
        </tbody>

    </table>




@endsection