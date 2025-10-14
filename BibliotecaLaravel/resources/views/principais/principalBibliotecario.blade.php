@extends('layouts.app')

@section('title', 'Principal Bibliotecario')

@section('content')
    <h1>Tela principal do bibliotecário</h1>
    <div class="container mt-5">
        <a href="{{ route('emprestimos-index') }}">Empréstimos</a>
        <br>
        <a href="{{ route('leitores-index') }}">Leitores</a>
        <br>
        <a href="{{ route('livros-index') }}">Livros</a>
    </div>
    <br>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Sair</button>
    </form>
        
    
@endsection