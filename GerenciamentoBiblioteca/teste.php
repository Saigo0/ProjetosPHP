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

        $livroDAO = new LivroDAO(Conexao::getPDO());
        $livro = new Livro();

        $livro->setISBN("2139090231");
        $livro->setTitulo("TituloAleatorio");
        $livro->setAutor("AutorAleatorio");
        $livro->setEditora("EditoraAleatoria");
        $livro->setAnoEdicao(2025);
        $livro->setNumPaginas(300);
        $livro->setLocalEdicao("AquiMesmo");
        $livro1 = $livroDAO->findByID(2);
        $livro1->setTitulo("NovoTitulo");
        $livroDAO->delete($livro1);

        $livros = $livroDAO->listAll();

        foreach($livros as $registroLivro){
            echo "ID: ". $registroLivro->getId() ."<br>ISBN: ". $registroLivro->getISBN() . "<br>Titulo: " . $registroLivro->getTitulo();
        }

    ?>

    <main>
        
    </main>
</body>
</html>