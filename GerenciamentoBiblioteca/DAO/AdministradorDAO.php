<?php 
    class AdministradorDAO{
        private PDO $pdo;
        private UsuarioDAO $usuarioDAO;

        public function __construct($pdo){
            $this->pdo = $pdo;
            $this->usuarioDAO = new UsuarioDAO($pdo);
        }

        public function create(Administrador $administrador){

            $idUsuario = $this->usuarioDAO->create($administrador);

            $administrador->setIdUsuario($idUsuario);

            $sql = "INSERT INTO administrador (id_usuario) VALUES (:id_usuario)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_usuario' => $administrador->getIdUsuario()
            ]);
        }

        public function listAll(){
            $sql = "SELECT * FROM administrador";
            $stmt = $this->pdo->query($sql);

            $administradores = $stmt->execute([PDO::FETCH_ASSOC]);
            return $stmt->execute([PDO::FETCH_ASSOC]);
        }

        public function update(Administrador $administrador){

            $sql = "UPDATE administrador SET
                id_usuario = :id_usuario WHERE id =:id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_usuario' => $administrador->getIdUsuario()]);
        }

        public function delete(Administrador $administrador){
            $sql = "DELETE FROM administrador WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $administrador->getId()]);
        }

        
    }
?>