<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste</title>
</head>
<body>

    <?php
        require_once "connection/Conexao.php";
        require_once "connection/PDO.php";
        require_once "model/Usuario.php";
        require_once "model/Pessoa.php";
        require_once "model/Livro.php";
        require_once "model/Leitor.php";
        require_once "model/ItemEmprestimo.php";
        require_once "model/Exemplar.php";
        require_once "model/Emprestimo.php";
        require_once "model/Bibliotecario.php";
        require_once "model/Administrador.php";

        require_once "DAO/UsuarioDAO.php";
        require_once "DAO/PessoaDAO.php";
        require_once "DAO/LivroDAO.php";
        require_once "DAO/LeitorDAO.php";
        
        require_once "DAO/ExemplarDAO.php";
        require_once "DAO/EmprestimoDAO.php";
        require_once "DAO/BibliotecarioDAO.php";
        require_once "DAO/AdministradorDAO.php";

        require_once "controller/UsuarioController.php";
        require_once "controller/LeitorController.php";
        require_once "controller/LivroController.php";
        require_once "controller/EmprestimoController.php";

        require_once "service/AuthService.php";


        $pdo = new PDO("mysql:host=localhost;dbname=gerenciamentobiblioteca", "root", "");

        $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
        $exemplar = new Exemplar();
        $exemplar->setCodigoExemplar("cod1");
        $exemplar->setLivroId("1");
        $exemplar->setStatus("Emprestado");

        $exemplar1 = $exemplarDAO->findByCodigoExemplar("cod1");
        $exemplar1->setCodigoExemplar("cod2");
        $exemplarDAO->update($exemplar1);

        $exemplares = $exemplarDAO->listAll();
        foreach($exemplares as $registroExemplar){
            echo "ID: ". $registroExemplar->getId() ."<br>Código de exemplar: ". $registroExemplar->getCodigoExemplar() . "<br>ID do livro: " . $registroExemplar->getLivroId(). "<br>Status: " . $registroExemplar->getStatus();
        }

    ?>

    <main>
        
    </main>
</body>
</html>