@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <header>
        <h1>Login</h1>
    </header>

    
        <main>
            <form action="{{ route('login-post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" name="login" id="login" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" required>
                </div>
                <div class="form-group">
                    <button type="submit">Entrar</button>
                </div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </main>
    
@endsection
