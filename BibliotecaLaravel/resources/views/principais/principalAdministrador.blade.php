@extends('layouts.app')

@section('title', 'Principal Administrador')

@section('content')
    <main>
        <h1>Bem vindo(a), @php
            $usuario = session('usuario_id') ? \App\Models\Usuario::with('pessoa')->find(session('usuario_id')) : null;
            echo $usuario ? $usuario->pessoa->nome : 'Administrador';
        @endphp</h1>
        <main>
            <section><a href="{{ route('leitores-index') }}">Gerenciar Leitores</a>
            <br></section>
            
            <section><a href="{{ route('bibliotecarios-index') }}">Gerenciar Bibliotecários</a>
            <br></section>
            
            <section>
                <a href="{{ route('emprestimos-index') }}">Gerenciar Empréstimos</a>
                <br>
            </section>
            <section>
                <a href="{{ route('livros-index') }}">Gerenciar Livros</a>
                <br>
            </section>
            <section>
                <a href="{{ route('administradores-index') }}">Administradores</a>
                <br>
            </section>
            
        </main>
        <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Sair</button>
    </form>
    </main>
@endsection