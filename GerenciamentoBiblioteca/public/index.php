<?php 

require_once __DIR__ . '/../bootstrap.php';

$action = $_GET['action'] ?? '';

switch($action){
    case 'cadastrarLeitor':
        $controller = new BibliotecarioController();
        $controller->cadastrarLeitor();
        break;
    
    case 'loginBibliotecario':
            
    default:
        echo "Ação inválida";
}