<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste</title>
</head>
<body>

    <?php
require_once "model/Usuario.php";
require_once "DAO/UsuarioDAO.php";
require_once "model/Pessoa.php";


$pdo = new PDO("mysql:host=localhost;dbname=gerenciamentobiblioteca", "root", "");

$usuarioDAO = new UsuarioDAO($pdo);

$usuario = new Usuario();


?>

    <h1>Teste</h1>
    <ul>
        
        
        <?php
        
        for ($i = 1; $i<=25; $i++){
            $usuario->setId($i);
            if($usuarioDAO->delete($usuario)){
                echo "Sucesso!";
            } else{
                echo "Erro!";
            }
        }

        

        ?>
        
    </ul>
</body>
</html>