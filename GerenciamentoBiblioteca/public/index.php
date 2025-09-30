<?php 

require_once __DIR__ . '/../bootstrap.php';

$action = strtolower(trim($_GET['action'] ?? ''));
$login = $_POST['loginUsuario'] ?? '';
$senha = $_POST['senhaUsuario'] ?? '';

var_dump($action);

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
                header("Location: ../view/TelaPrincipalAdministrador.php");
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

    default:
        
            
}