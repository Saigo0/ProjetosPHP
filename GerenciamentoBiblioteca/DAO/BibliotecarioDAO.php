<?php 
    class BibliotecarioDAO{
        private PDO $pdo;
        private UsuarioDAO $usuarioDAO;

        public function __construct(PDO $pdo)
        {
            $this->usuarioDAO = new UsuarioDAO($pdo);
            $this->pdo = $pdo;
        }

        public function create(Bibliotecario $bibliotecario){

            $usuario = $bibliotecario;
            $idUsuario = $this->usuarioDAO->create($usuario);
            
            $bibliotecario->setIdUsuario($idUsuario);

            $sql = "INSERT INTO bibliotecario (id_usuario, registroCRB, valorCRB) VALUES (:id_usuario, :registroCRB, :valorCRB)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_usuario' => $bibliotecario->getIdUsuario(),
                'registroCRB' => $bibliotecario->getRegistroCRB(),
                'valorCRB' => $bibliotecario ->getValorCRB()
            ]);
        }

        public function update(Bibliotecario $bibliotecario){

            $this->usuarioDAO->update($bibliotecario);


            $sql = "UPDATE bilbiotecario SET
                id_usuario = :id_usuario,
                multasPendentes = :multasPendentes";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_usuario' => $bibliotecario->getIdUsuario(),
                'registroCRB' => $bibliotecario->getRegistroCRB(),
                'valorCRB' => $bibliotecario->getValorCRB()
            ]);
        }

        public function listAll(){
            $sql = "SELECT * FROM bibliotecario";
            $stmt = $this->pdo->query($sql);

            $bibliotecarios = $stmt->execute([PDO::FETCH_ASSOC]);

            return $bibliotecarios;
        }

        public function findByID(int $id){
            $sql = "SELECT * FROM WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id' => $id]);
        }

        public function delete(Bibliotecario $bibliotecario){
            $sql = "DELETE FROM bilbiotecario WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $bibliotecario->getId()
            ]);
        }
    }
?>