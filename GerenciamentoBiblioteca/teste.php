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

        
        $usuario = new Usuario();
        $usuarioDAO = new UsuarioDAO(Conexao::getPDO());
        
        
        $usuario->setNome("Alberto");
        $usuario->setRG("89089098098");
        $usuario->setCPF("08744984132");
        $usuario->setDataNascimento(new DateTime("2004-08-20"));
        $usuario->setEmail("email@email.com");
        $usuario->setEndereco("R. Dr.Getulio Vargas");
        $usuario->setTelefone("61978906274");
        $usuario->setLogin("alb902");
        $usuario->setNivelAcesso("Leitor");
        $usuario->setSenha("albto1901@");
        $usuarioDAO->create($usuario);
        
        
        $usuarios = $usuarioDAO->listAll();
        foreach($usuarios as $usuario){
            /*$usuarioDAO->delete($usuario);*/
            echo "<br>ID: " . $usuario->getId() . "<br>ID da pessoa: " . $usuario->getIdPessoa() . "<br>Nome: " . $usuario->getNome() . "<br>RG: " . $usuario->getRG() . "<br>CPF: " . $usuario->getCPF() . "<br>Data de nascimento: " . $usuario->getDataNascimento()->format('d/m/Y') . "<br>Email: " . $usuario->getEmail() . "<br>Endereço: " . $usuario->getEndereco() . "<br>Telefone: " . $usuario->getTelefone() . "<br>Login: ". $usuario->getLogin() . "<br>Nivel de acesso: " . $usuario->getNivelAcesso() . "<br>Senha: " . $usuario->getSenha() . "<br>Data de Cadastro: " . $usuario->getDataCadastro() .  "<br><br>";
        }
    ?>

    <main>
        <form action="" method = "post">
            <label for="Inserir nome"></label>
            <input type="text" name="nome" id="nome">
            <input type="button" name="Enviar" id="enviar">
        </form>
    </main>
</body>
</html>