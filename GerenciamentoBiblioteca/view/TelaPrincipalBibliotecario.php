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
            <h2>Suas funções</h2>
        
                    <section>
                        <h3>Leitores</h3>
                        <button onclick="window.location.assign('../public/index.php?action=gerenciarleitores')">Gerenciar leitores</button>
                    </section>

                    <br>

                    <section>
                        <h3>Livros</h3>
                        <button onclick="window.location.assign('../public/index.php?action=gerenciarlivros')">Gerenciar livros</button>
                    </section>
                    
                    <br>

                    <section>
                        <h3>Empréstimos</h3>
                        <button onclick="window.location.assign('../public/index.php?action=gerenciaremprestimos')">Gerenciar empréstimos</button>    
                    </section>

                    <section>
                        <h3>Exemplares</h3>
                        <button onclick="window.location.assign('../public/index.php?action=gerenciarexemplares')">Gerenciar exemplares</button>
                    </section>
            
    </main>

    <div>
        <form action="../public/index.php?action=logout" method = "post">
            <input type="submit" name="logout" id="logout" value="Fazer logout">
        </form>
    </div>
</body>
</html>