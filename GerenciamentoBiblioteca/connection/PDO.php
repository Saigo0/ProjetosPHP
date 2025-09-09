<?php 
    $host = "localhost";
    $dbname ="gerenciamentobiblioteca";
    $user = "root";
    $pass = "";

    try{
        $pdo = new PDO("mysql:host =$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Conexão realizada!";
    } catch (PDOException $e){
        echo"Erro na conexão".$e->getMessage();
    }
?>