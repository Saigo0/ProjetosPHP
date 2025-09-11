<?php 
    class AdministradorDAO{
        private PDO $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        
    }
?>