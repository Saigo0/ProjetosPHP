<?php 
    class LeitorDAO{
        private PDO $pdo;
        private UsuarioDAO $usuarioDAO;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
            $this->usuarioDAO = new UsuarioDAO($pdo);
        }

        public function create(Leitor $leitor){
            $this->pdo->beginTransaction();

            $usuario = $leitor;
            $idUsuario = $this->usuarioDAO->create($usuario);
            $leitor->setIdUsuario($idUsuario);

            $sql = "INSERT INTO leitor (id_usuario, multasPendentes) VALUES (:id_usuario, :multasPendentes)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_usuario' => $leitor->getIdUsuario(),
                'multasPendentes' => $leitor->getMultasPendentes()
            ]);

            return $this->pdo->lastInsertId();
        }

        public function update(Leitor $leitor){
            $this->usuarioDAO->update($leitor);


            $sqlLeitor = "UPDATE leitor SET 
                id_usuario = :id_usuario,
                multasPendentes = multasPendentes";
            $stmtLeitor = $this->pdo->prepare($sqlLeitor);
            $stmtLeitor->execute([
                'id_usuario' => $leitor->getIdUsuario(),
                'multasPendentes' => $leitor->getMultasPendentes()
            ]);
        }

        public function listAll(){
            $sql = "SELECT * FROM leitor";
            $stmt = $this->pdo->query($sql);

            $leitores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $leitores;
        }
        
        public function findByID(int $id){
            $sql = "SELECT * FROM leitor WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $arrayAsso = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach($arrayAsso as  $registroLeitor){
                $leitor = new Leitor();
                $leitor->setId($registroLeitor['id']);
                $leitor->setIdUsuario($registroLeitor['id_usuario']);
                $leitor->setMultasPendentes($registroLeitor['multasPendentes']);
            }
            return $leitor;
        }

        public function findByName(string $nome){
            $sql = "SELECT l.* FROM leitor l
                    JOIN usuario u on l.id_usuario = u.id
                    JOIN pessoa p ON u.id_pessoa = p.id
                    WHERE p.nome = :nome";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['nome' => $nome]);
            $arrayAsso = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $leitores = [];
            foreach($arrayAsso as $registroLeitor){
                $leitor = new Leitor();
                $leitor->setId($registroLeitor['id']);
                $leitor->setIdUsuario($registroLeitor['id_usuario']);
                $leitor->setMultasPendentes($registroLeitor['multasPendentes']);
                $leitores += $leitor;
            }
            return $leitores;
        }

        public function delete(Leitor $leitor){
            $sql = "DELETE FROM leitor WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $leitor->getId()]);
        }


    }
?>