@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    <div class="container mt-5">
        <h1>Listagem de emprestimos</h1>
        <hr>
        <a href="{{ route('emprestimos-create') }}" class="btn btn-primary mb-3">Criar novo emprestimo</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Leitor</th>
                <th scope="col">Data do Empréstimo</th>
                <th scope="col">Data de Devolução</th>
                <th scope="col">Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($emprestimos as $emprestimo)
                <tr>
                    <th scope="row">{{ $emprestimo->id }}</th>
                    <td>{{ $emprestimo->leitor->usuario->pessoa->nome }}</td>
                    <td>{{ $emprestimo->dataEmprestimo }}</td>
                    <td>{{ $emprestimo->dataDevolucao }}</td>
                    <td>{{ $emprestimo->status }}</td>
                    <th class="d-flex">
                            <form action="{{ route('emprestimos-devolver', ['id' => $emprestimo->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708z"/>
                                </svg>
                                Devolver
                            </button>
                        </form>
                        <form action="{{ route('emprestimos-destroy', ['id'=>$emprestimo->id]) }}" method="POST">
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