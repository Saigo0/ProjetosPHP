<?php 

require_once __DIR__ . '/../bootstrap.php';

$action = $_GET['action'] ?? '';

switch($action){
    case 'cadastrarLeitor':
        $controller = new LeitorController();
        $controller->cadastrarLeitor();
        break;
    
    default:
        echo "Ação inválida";
}