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
        require_once "service/EmprestimoService.php";


        $pdo = new PDO("mysql:host=localhost;dbname=gerenciamentobiblioteca", "root", "");

        $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
        $emprestimo = new Emprestimo();
        $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
        $exemplar = new Exemplar();
        $exemplar1 = new Exemplar();
        $leitorDAO = new LeitorDAO(Conexao::getPDO());
        $leitor = new Leitor();
        $emprestimoService = new EmprestimoService();

        /*
        $leitor = $leitorDAO->findByID(30);

        $exemplar = $exemplarDAO->findByCodigoExemplar("cod2");
        $exemplar1 = $exemplarDAO->findByCodigoExemplar("cod3");

        $exemplar->setStatus("Disponivel");
        $exemplar1->setStatus("Disponivel");

        $exemplarDAO->update($exemplar);
        $exemplarDAO->update($exemplar1);

        

        $listaExemplares = [];
        $listaExemplares [] = $exemplarDAO->findByCodigoExemplar("cod2");
        $listaExemplares [] = $exemplarDAO->findByCodigoExemplar("cod3");

        $emprestimoService->realizarEmprestimo($leitor, $listaExemplares);*/

        $emprestimoService->devolverEmprestimo($emprestimoDAO->findByID(44));

        $emprestimos = $emprestimoDAO->listAll();

        foreach($emprestimos as $registroEmprestimo){
            echo "<br>ID do empréstimo: ". $registroEmprestimo->getId() ."<br>Id do leitor: ". $registroEmprestimo->getLeitor()->getId() . "<br>Data do empréstimo: " . $registroEmprestimo->getDataEmprestimo()->format('Y-m-d'). "<br>Data de devolução: " . $registroEmprestimo->getDataDevolucao()->format('Y-m-d') . "<br>Status: " . $registroEmprestimo->getStatus() . "<br> Descrição: " . $registroEmprestimo->getDescricao() . "<br><br> Itens do empréstimo: ";

            foreach($registroEmprestimo->getItensEmprestimo() as $itemEmprestimo){
                echo "<br><br>[ID do item do empréstimo: " .$itemEmprestimo->getId(). "<br>ID do exemplar: " . $itemEmprestimo->getIdExemplar() . "<br>ID do empréstimo: " . $itemEmprestimo->getIdEmprestimo() . "]";
            }
            echo "<br><br>";
        }

    ?>

    <main>
        
    </main>
</body>
</html>