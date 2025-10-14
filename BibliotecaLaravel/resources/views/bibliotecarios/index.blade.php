@extends('layouts.app')

@section('title', 'Listagem')

@section('content')
    
    <h1>Listagem de Bibliotecários</h1>
    <hr>
    <a href="{{ route('bibliotecarios-create') }}" class="btn btn-primary mb-3">Criar novo bibliotecario</a>


    <table>
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
                    </a>
                    <a href="{{ route('bibliotecarios-destroy', ['id'=>$bibliotecario->id]) }}">Deletar</a>
                </th>
                </tr>
            @endforeach
        </tbody>

    </table>




@endsection