<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Cadastro de leitor</h1>
    </header>
    
    
    <main>
        <form action="../public/index.php?action=cadastrarleitor" method="POST">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
            <label for="RG">RG</label>
            <input type="text" name="RG" id="RG">
            <label for="CPF">CPF</label>
            <input type="text" name="CPF" id="CPF">
            <label for="dataNascimento">Data de nascimento</label>
            <input type="date" name="dataNascimento" id="dataNascimento">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone">
            <label for="login">Login</label>
            <input type="text" name="login" id="login">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <input type="submit" value = "Cadastrar">
        </form>
    </main>

    <section>
        <a href="index.php?action=telaprincipal">Voltar para a página inicial</a>
    </section>

    <section>
        <a href="index.php?action=gerenciarleitores">Cancelar</a>
    </section>
</body>
</html>