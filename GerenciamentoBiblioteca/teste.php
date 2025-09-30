<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste</title>
</head>
<body>

    <?php
        require_once __DIR__ . "/bootstrap.php";


        $pdo = new PDO("mysql:host=localhost;dbname=gerenciamentobiblioteca", "root", "");

        $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
        $emprestimo = new Emprestimo();
        $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
        $exemplar = new Exemplar();
        $exemplar1 = new Exemplar();
        $leitorDAO = new LeitorDAO(Conexao::getPDO());
        $leitor = new Leitor();
        $emprestimoService = new EmprestimoService();
        $bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());
        $bibliotecario = new Bibliotecario();
        $bibliotecario->setNome("Rivaldo");
        $bibliotecario->setRG("890098089");
        $bibliotecario->setCPF("08744978934");
        $bibliotecario->setDataNascimento(new DateTime());
        $bibliotecario->setEmail("sdaosido@gmail.com");
        $bibliotecario->setEndereco("rararasd");
        $bibliotecario->setTelefone("78978786767");
        $bibliotecario->setLogin("riv234");
        $bibliotecario->setSenha("riv23456");
        $bibliotecario->setNivelAcesso("BIBLIOTECARIO");
        $bibliotecario->setDataCadastro(new DateTime());
        $bibliotecario->setRegistroCRB("registro");
        $bibliotecario->setValorCRB(234);
        $bibliotecarioDAO->create($bibliotecario);
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

        

        

    ?>

    <main>
        
    </main>
</body>
</html>