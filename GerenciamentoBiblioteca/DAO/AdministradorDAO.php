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

        public function findByID(int $id){
            $sql = "SELECT * FROM administrador WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id' => $id]);
        }

        public function findByIdUsuario(int $id){
            $sql = "SELECT a.*, u.id_pessoa, u.login, u.senha, u.nivelAcesso, u.dataCadastro, p.nome, p.RG, p.CPF, p.dataNascimento, p.email, p.endereco, p.telefone from administrador a
            JOIN usuario u on u.id = a.id_usuario
            JOIN pessoa p on p.id = u.id_pessoa
            WHERE u.id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $registroAdministrador = $stmt->fetch(PDO::FETCH_ASSOC);

            $administrador = new Bibliotecario();
            $administrador->setId($registroAdministrador['id']);
            $administrador->setIdPessoa($registroAdministrador['id_pessoa']);
            $administrador->setIdUsuario($registroAdministrador['id_usuario']);
            $administrador->setNome($registroAdministrador['nome']);
            $administrador->setRG($registroAdministrador['RG']);
            $administrador->setCPF($registroAdministrador['CPF']);
            $administrador->setDataNascimento(new DateTime($registroAdministrador['dataNascimento']));
            $administrador->setEmail($registroAdministrador['email']);
            $administrador->setEndereco($registroAdministrador['endereco']);
            $administrador->setTelefone($registroAdministrador['telefone']);
            $administrador->setLogin($registroAdministrador['login']);
            $administrador->setSenha($registroAdministrador['senha']);
            $administrador->setDataCadastro(new DateTime($registroAdministrador['dataCadastro']));
            $administrador->setNivelAcesso($registroAdministrador['nivelAcesso']);

            return $administrador;
        }

        public function delete(Administrador $administrador){
            $sql = "DELETE FROM administrador WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $administrador->getId()]);
        }

        
    }
?>