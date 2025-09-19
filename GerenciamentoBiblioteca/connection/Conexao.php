<?php 
    class Conexao{
        public static function getPDO(){
            static $pdo = null;
            if($pdo === null){
                $pdo = new PDO('mysql:host=localhost;dbname=gerenciamentobiblioteca', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $pdo;
        }
    }

