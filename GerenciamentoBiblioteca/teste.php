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


        $pdo = new PDO("mysql:host=localhost;dbname=gerenciamentobiblioteca", "root", "");

        
        $leitor = new Leitor();
        $leitorDAO = new LeitorDAO(Conexao::getPDO());
        $leitor->setNome("André");
        $leitor->setRG("89089098098");
        $leitor->setCPF("08744984132");
        $leitor->setDataNascimento(new DateTime("2004-07-27"));
        $leitor->setEmail("email@email.com");
        $leitor->setEndereco("R. Dr.Getulio Vargas");
        $leitor->setTelefone("61978906274");
        $leitor->setLogin("jose902");
        $leitor->setNivelAcesso("Leitor");
        $leitor->setSenha("jose1901@");
        $leitor->setMultasPendentes(true);

        $leitor = $leitorDAO->findByID(9);
        $leitorDAO->delete($leitor);
        $leitores = $leitorDAO->listAll();
        foreach($leitores as $leitor){
            echo "<br>ID: " . $leitor->getId() . "<br>ID da pessoa: " . $leitor->getIdPessoa() . "<br>ID do usuário: ". $leitor->getIdUsuario() ."<br>Nome: " . $leitor->getNome() . "<br>RG: " . $leitor->getRG() . "<br>CPF: " . $leitor->getCPF() . "<br>Data de nascimento: " . $leitor->getDataNascimento()->format('d/m/Y') . "<br>Email: " . $leitor->getEmail() . "<br>Endereço: " . $leitor->getEndereco() . "<br>Telefone: " . $leitor->getTelefone() . "<br>Login: ". $leitor->getLogin() . "<br>Nivel de acesso: " . $leitor->getNivelAcesso() . "<br>Senha: " . $leitor->getSenha() . "<br>Data de Cadastro: " . $leitor->getDataCadastro()->format('d/m/Y') . "<br>Multas pendentes: ". $leitor->getMultasPendentes() ."<br><br>";
        }
    ?>

    <main>
        
    </main>
</body>
</html>