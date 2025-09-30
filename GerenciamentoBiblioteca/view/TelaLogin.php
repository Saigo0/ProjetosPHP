<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Tela de login</h1>
    </header>
    <main>
        <form action="../public/index.php?action=login" method="post">
            <label for="loginUsuario">Login</label>
            <input type="text" name="loginUsuario" id="loginUsuario">
            <label for="senhaUsuario">Senha</label>
            <input type="password" name="senhaUsuario" id="senhaUsuario">
            <input type="submit" name="botaoLogin" id="botaoLogin" value = "Login">
        </form>
    </main>
</body>
</html>