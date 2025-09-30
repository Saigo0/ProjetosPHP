<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar bibliotecário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Cadastro de bibliotecário</h1></header>
    <main>
        <form action="../public/index.php?action=cadastrarBibliotecario" method="post">
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
            <label for="registroCRB">Registro CRB</label>
            <input type="text" name="registroCRB" id="registroCRB">
            <label for="valorCRB">Valor CRB</label>
            <input type="text" name="valorCRB" id="valorCRB">
            <label for="login">Login</label>
            <input type="text" name="login" id="login">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <input type="submit" value = "Cadastrar">
        </form>
    </main>
    
</body>
</html>