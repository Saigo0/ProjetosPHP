@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    <div class="container mt-5">
        <h1>Listagem de Leitores</h1>
        <hr>
        <a href="{{ route('leitores-create') }}" class="btn btn-primary mb-3">Criar novo leitor</a>
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
            @foreach ($leitores as $leitor)
                <tr>
                    <th scope="row">{{ $leitor->id }}</th>
                    <td>{{ $leitor->usuario->pessoa->nome }}</td>
                    <td>{{ $leitor->usuario->pessoa->email }}</td>
                    <td>{{ $leitor->usuario->pessoa->telefone }}</td>
                    <td>{{ $leitor->usuario->pessoa->endereco }}</td>
                    <th class="d-flex">
                    <a href="{{ route('leitores-edit', ['id'=>$leitor->id]) }}" class="btn btn-primary">
                         Editar     
                    </a>
                    <div class="">
                        <form action="{{ route('leitores-destroy', ['id'=>$leitor->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Deletar
                            </button> 
                        </form>
                    </div>
                </th>
                </tr>
            @endforeach
        </tbody>

    </table>




@endsection