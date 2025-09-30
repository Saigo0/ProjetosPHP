<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php

        require_once __DIR__ . '/../bootstrap.php';
        

        if(!isset($_SESSION['idUsuario'])){
            header("Location: ../view/TelaLoginBibliotecario.php");
            exit;
        }

        $usuarioDAO = new UsuarioDAO(Conexao::getPDO());
        $nomeUsuario = $usuarioDAO->findByID($_SESSION['idUsuario'])->getNome();
    ?>
    <header>
        <h1>Bem-vindo(a), <?php echo $nomeUsuario ?></h1>
        
    </header>
    <main>
        <section><a href="TelaCadastrarLeitor.php">Cadastrar novo leitor</a></section>
        <section><a href="TelaCadastrarLivro.php">Cadastrar novo livro</a></section>
        <section><a href="TelaCadastrarExemplar.php">Cadastrar novo exemplar</a></section>
    </main>

    <div>
        <form action="../public/index.php?action=logout" method = "post">
            <input type="submit" name="logout" id="logout" value="Fazer logout">
        </form>
</div>
</body>
</html>