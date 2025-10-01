<?php 

require_once __DIR__ . '/../bootstrap.php';

$action = strtolower(trim($_GET['action'] ?? ''));
$login = $_POST['loginUsuario'] ?? '';
$senha = $_POST['senhaUsuario'] ?? '';


session_start();

switch($action){
    case 'cadastrarLeitor':
        $controller = new BibliotecarioController();
        $controller->cadastrarLeitor();
        break;
    
    case 'login':
        $var = true; 
        $authService = new AuthService();
        $usuarioDAO = new UsuarioDAO(Conexao::getPDO());
        $controller = new BibliotecarioController();
        if($authService->autenticar($login, $senha)){
            $usuario = $usuarioDAO->findByID($_SESSION['idUsuario']);
            if($usuario->getNivelAcesso() === 'BIBLIOTECARIO'){
                $controller->loginBibliotecario();
                exit;
            } 
            if($usuario->getNivelAcesso() === 'ADMINISTRADOR'){
                $controller = new AdministradorController();
                $controller->loginAdministrador();
                exit;
            }
        } else{
            throw new InvalidArgumentException("Erro na autenticação em index.php");
        }
        
        break;

    case 'logout':
        $controller = new UsuarioController();
        $controller->deslogarUsuario();
        break;

    case 'cadastrarLivro':
        $controller = new LivroController();
        $controller->criarLivro();
        break;

    case 'cadastrarExemplar':
        $controller = new ExemplarController();
        $controller->criarExemplar();
        break;
    
    case 'realizarEmprestimo':
        $controller = new EmprestimoController();
        $controller->realizarEmprestimo();
        break;
       
    case 'devolverEmprestimo':
        $controller = new EmprestimoController();
        $controller->devolverEmprestimo();
        break;

    case 'cadastrarBibliotecario':
        $controller = new AdministradorController();
        $controller->criarBibliotecario();
        break;

    case 'excluirBibliotecario':
        $controller = new AdministradorController();
        $controller->deletarBibliotecario();
        break;

    default:
        echo "Default index";
}