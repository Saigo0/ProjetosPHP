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
                $controller->telaPrincipalBibliotecario();
                exit;
            } 
            if($usuario->getNivelAcesso() === 'ADMINISTRADOR'){
                $controller = new AdministradorController();
                $controller->telaPrincipalAdministrador();
                exit;
            }
        } else{
            throw new InvalidArgumentException("Erro na autenticação em index.php");
        }
        
        break;

    case 'telacadastrarleitor':
        $controller = new BibliotecarioController();
        $controller->telaCadastrarLeitor();
        break;
    
    case 'telalogin':
        $controller = new AuthService();
        $controller->telaLogin();
        break;

    case 'logout':
        $controller = new UsuarioController();
        $controller->deslogarUsuario();
        break;

    case 'telarealizaremprestimo':
        $controller = new TelaController();
        $controller->telaRealizarEmprestimo();
        break;

    case 'cadastrarlivro':
        $controller = new LivroController();
        $controller->criarLivro();
        break;

    case 'cadastrarexemplar':
        $controller = new ExemplarController();
        $controller->criarExemplar();
        break;
    
    case 'telacadastrarlivro':
        $controller = new LivroController();
        $controller->telaCadastrarLivro();
        break;
    
    case 'realizaremprestimo':
        $controller = new EmprestimoController();
        $controller->realizarEmprestimo();
        break;
       
    case 'devolveremprestimo':
        $controller = new EmprestimoController();
        $controller->devolverEmprestimo();
        break;

    case 'cadastrarbibliotecario':
        $controller = new AdministradorController();
        $controller->criarBibliotecario();
        break;

    case 'excluirbibliotecario':
        $controller = new AdministradorController();
        $controller->deletarBibliotecario();
        break;

    case 'editarbibliotecario':
        $controller = new AdministradorController();
        $controller->editarBibliotecario();
        break;

    case 'atualizarbibliotecario':
        $controller = new AdministradorController();
        $controller->atualizarBibliotecario();
        break;

    case 'gerenciarbibliotecarios':
        $controller = new AdministradorController();
        $controller->listarBibliotecarios();
        break;

    case 'telacadastrarbibliotecario':
        require __DIR__ . '/../view/TelaCadastrarBibliotecario.php';
        break;
    
    case 'telacadastrarexemplar':
        $controller = new ExemplarController();
        $controller->telaCadastrarExemplar();
        break;

    case 'telaprincipaladministrador':
        $controller = new TelaController();
        $controller->telaPrincipalAdministrador();
        break;

    case 'telaprincipalbibliotecario':
        $controller = new TelaController();
        $controller->telaPrincipalBibliotecario();
        break;

    case 'telaprincipal':
        $controller = new TelaController();
        $controller->redirecionarPorNivelAcesso();
        break;

    default:
        echo "Rota não encontrada.";
        break;
}