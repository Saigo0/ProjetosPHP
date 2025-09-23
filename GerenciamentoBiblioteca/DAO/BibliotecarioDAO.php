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

        public function findByIdUsuario(int $id){
            $sql = "SELECT b.*, u.id_pessoa, u.login, u.senha, u.nivelAcesso, u.dataCadastro, p.nome, p.RG, p.CPF, p.dataNascimento, p.email, p.endereco, p.telefone from bibliotecario b
            JOIN usuario u on u.id = b.id_usuario
            JOIN pessoa p on p.id = u.id_pessoa
            WHERE u.id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $registrobiBliotecario = $stmt->fetch(PDO::FETCH_ASSOC);

            $bibliotecario = new Bibliotecario();
            $bibliotecario->setId($registrobiBliotecario['id']);
            $bibliotecario->setIdPessoa($registrobiBliotecario['id_pessoa']);
            $bibliotecario->setIdUsuario($registrobiBliotecario['id_usuario']);
            $bibliotecario->setNome($registrobiBliotecario['nome']);
            $bibliotecario->setRG($registrobiBliotecario['RG']);
            $bibliotecario->setCPF($registrobiBliotecario['CPF']);
            $bibliotecario->setDataNascimento(new DateTime($registrobiBliotecario['dataNascimento']));
            $bibliotecario->setEmail($registrobiBliotecario['email']);
            $bibliotecario->setEndereco($registrobiBliotecario['endereco']);
            $bibliotecario->setTelefone($registrobiBliotecario['telefone']);
            $bibliotecario->setLogin($registrobiBliotecario['login']);
            $bibliotecario->setSenha($registrobiBliotecario['senha']);
            $bibliotecario->setDataCadastro(new DateTime($registrobiBliotecario['dataCadastro']));
            $bibliotecario->setNivelAcesso($registrobiBliotecario['nivelAcesso']);
            $bibliotecario->setRegistroCRB($registrobiBliotecario['registroCRB']);
            $bibliotecario->setValorCRB($registrobiBliotecario['valorCRB']);
            
            return $bibliotecario;
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