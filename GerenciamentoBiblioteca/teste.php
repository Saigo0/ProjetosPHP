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

        $leitorDAO = new LeitorDAO(Conexao::getPDO());
        $leitor = new Leitor();


        
        $autenticador = new AuthService();
        $usuarioDAO = new UsuarioDAO(Conexao::getPDO());
        $leitor->setNome("André");
        $leitor->setRG("89089098098");
        $leitor->setCPF("08744984132");
        $leitor->setDataNascimento(new DateTime("2004-07-27"));
        $leitor->setEmail("email@email.com");
        $leitor->setEndereco("R. Dr. Getulio Vargas");
        $leitor->setTelefone("61978906274");
        $leitor->setLogin("jose902");
        $leitor->setNivelAcesso("leitor");
        $leitor->setSenha("jose1901@");
        $leitor->setMultasPendentes(false);

        $leitorDAO->create($leitor);
        $leitorTeste = $leitorDAO->findByIdUsuario(96);
        $authUser = $autenticador->autenticar($usuarioDAO->findByID(96)->getLogin(), "jose1901@");
        $usuarios = $usuarioDAO->listAll();
        var_dump($authUser);
        echo $authUser->getNome();
        foreach($usuarios as $usuarioleitor){
            echo "<br>ID: " . $usuarioleitor->getId() . "<br>ID da pessoa: " . $usuarioleitor->getIdPessoa() ."<br>Nome: " . $usuarioleitor->getNome() . "<br>RG: " . $usuarioleitor->getRG() . "<br>CPF: " . $usuarioleitor->getCPF() . "<br>Data de nascimento: " . $usuarioleitor->getDataNascimento()->format('d/m/Y') . "<br>Email: " . $usuarioleitor->getEmail() . "<br>Endereço: " . $usuarioleitor->getEndereco() . "<br>Telefone: " . $usuarioleitor->getTelefone() . "<br>Login: ". $usuarioleitor->getLogin() . "<br>Nivel de acesso: " . $usuarioleitor->getNivelAcesso() . "<br>Senha: " . $usuarioleitor->getSenha() . "<br>Data de Cadastro: " . $usuarioleitor->getDataCadastro()->format('d/m/Y') ."<br><br>";
        }
    ?>

    <main>
        
    </main>
</body>
</html>