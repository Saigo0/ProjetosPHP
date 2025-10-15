@extends('layouts.app')

@section('title', 'Listagem')


@section('content')
    
        <header>
            <h1>Listagem de Leitores</h1>
        </header>
        
        <main>
            <a href="{{ route('leitores-create') }}" class="btn btn-primary mb-3">Criar novo leitor</a>
                
            
                <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Endereço</th>
                    <th>Pendente</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leitores as $leitor)
                    <tr>
                        <td scope="row">{{ $leitor->id }}</td>
                        <td>{{ $leitor->usuario->pessoa->nome }}</td>
                        <td>{{ $leitor->usuario->pessoa->email }}</td>
                        <td>{{ $leitor->usuario->pessoa->telefone }}</td>
                        <td>{{ $leitor->usuario->pessoa->endereco }}</td>
                        @php
                            echo "<td style='color:" . ($leitor->pendente ? "red" : "green") . ";'>" 
                                . ($leitor->pendente ? 'Sim' : 'Não') . "</td>";
                        @endphp
                        <td>
                            <a href="{{ route('leitores-edit', ['id'=>$leitor->id]) }}" class="btn btn-primary">
                                Editar
                            </a>

                            <a href="#" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir?')) document.getElementById('delete-{{ $leitor->id }}').submit();">
                                    Deletar
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1, etc..."/>
                                    </svg>
                            </a>

                            <form id = "delete-{{ $leitor->id }}" action="{{ route('leitores-destroy', $leitor->id) }}" method="POST" style="display:none;">
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