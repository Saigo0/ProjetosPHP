<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRADOR</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php 
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['idUsuario']) || $_SESSION['nivelAcesso'] !== 'ADMINISTRADOR'){
            header("Location: ../public/index?action=telalogin");
            exit;
        }
    ?>

    <header><h1>Bem-vindo, Administrador!</h1></header>
    
            <section>
                <h2>Funções Administrador</h2>
                <section>
                    <h3>Bibliotecários</h3>
                    <button onclick="window.location.assign('../public/index.php?action=gerenciarbibliotecarios')">Gerenciar bibliotecários</button>
                </section>
                        
            </section>

            <section>
                <h2>Funções Bibliotecário</h2>
                    <section>
                        <h3>Leitores</h3>
                        
                        <button>Gerenciar leitores</button>
                        
                    
                    
                    </section>
                    <br>
                    <section>
                        <h3>Livros</h3>
                        <button>Gerenciar livros</button>
                    </section>
                    <br>
                    <section>
                        <h3>Empréstimos</h3>
                        <button>Gerenciar empréstimos</button>
                        
                    </section>
            </section>

            <div>
                <form action="../public/index.php?action=logout" method = "post">
                    <input type="submit" name="logout" id="logout" value="Fazer logout">
                </form>
            </div>
           
        
    
</body>
</html>