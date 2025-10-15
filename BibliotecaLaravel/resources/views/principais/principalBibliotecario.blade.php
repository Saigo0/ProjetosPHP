@extends('layouts.app')

@section('title', 'Principal Bibliotecario')

@section('content')
    <header>
        <h1>Bem vindo(a), @php
                $usuario = session('usuario_id') ? \App\Models\Usuario::with('pessoa')->find(session('usuario_id')) : null;
                echo $usuario ? $usuario->pessoa->nome : 'Bibliotecário';
            @endphp</h1>
    </header>
    
        <main>
            <section><a href="{{ route('emprestimos-index') }}">Gerenciar Empréstimos</a></section>
            <br>
            <section><a href="{{ route('leitores-index') }}">Gerenciar Leitores</a></section>
            <br>
            <section><a href="{{ route('livros-index') }}">Gerenciar Livros</a></section>
        </main>
    
    <br>
    <section>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger">Sair</button>
        </form>
    </section>
        
    
@endsection