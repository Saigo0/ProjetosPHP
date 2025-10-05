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
        $administradorDAO = new AdministradorDAO(Conexao::getPDO());
        $administrador = new Administrador();
        $administrador->setNome("José");
        $administrador->setRG("890098089");
        $administrador->setCPF("08744978934");
        $administrador->setDataNascimento(new DateTime());
        $administrador->setEmail("sdaosido@gmail.com");
        $administrador->setEndereco("rararasd");
        $administrador->setTelefone("78978786767");
        $administrador->setLogin("jos123");
        $administrador->setSenha("jos123456");
        $administrador->setNivelAcesso("ADMINISTRADOR");
        $administrador->setDataCadastro(new DateTime());
        $administradorDAO->create($administrador);
        
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