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

             $sqlPessoa = "INSERT INTO pessoa (nome, RG, CPF, dataNascimento, email, endereco, telefone) VALUES (:nome, :RG, :CPF, :dataNascimento, :email, :endereco, :telefone)";

            $stmt = $this->pdo->prepare($sqlPessoa);
            $stmt->execute([
                'nome' => $bibliotecario->getNome(),
                'RG' => $bibliotecario->getRG(),
                'CPF' => $bibliotecario->getCPF(),
                'dataNascimento' => $bibliotecario->getDataNascimento()->format('Y-m-d'),
                'email' => $bibliotecario->getEmail(),
                'endereco' => $bibliotecario->getEndereco(),
                'telefone' => $bibliotecario->getTelefone()
            ]);

            $idPessoa = (int)$this->pdo->lastInsertId();
            $bibliotecario->setIdPessoa($idPessoa);
            
            $sqlUsuario = "INSERT INTO usuario (id_pessoa, login, nivelAcesso, senha, dataCadastro) VALUES (:id_pessoa, :login, :nivelAcesso, :senha, :dataCadastro)";

            $stmt = $this->pdo->prepare($sqlUsuario);
            $stmt ->execute([
                'id_pessoa' => $bibliotecario->getIdPessoa(),
                'login' => $bibliotecario->getLogin(),
                'nivelAcesso' => $bibliotecario->getNivelAcesso(),
                'senha' => $bibliotecario->getSenha(),
                'dataCadastro' => $bibliotecario->getDataCadastro()->format('Y-m-d')
            ]);

            $idUsuario = (int)$this->pdo->lastInsertId();
            $bibliotecario->setIdUsuario($idUsuario);

            $sqlLeitor = "INSERT INTO bibliotecario (id_usuario, registroCRB, valorCRB) VALUES (:id_usuario, :registroCRB, :valorCRB)";
            $stmt = $this->pdo->prepare($sqlLeitor);
            $stmt->execute([
                'id_usuario' => $bibliotecario->getIdUsuario(),
                'registroCRB' => $bibliotecario->getRegistroCRB(),
                'valorCRB' => $bibliotecario->getValorCRB()
            ]);

            return $this->pdo->lastInsertId();
        }

        public function update(Bibliotecario $bibliotecario){

            $sqlPessoa = "UPDATE pessoa SET
                  nome = :nome,
                  RG = :RG,
                  CPF = :CPF,
                  dataNascimento = :dataNascimento,
                  email = :email,
                  endereco = :endereco,
                  telefone = :telefone
                  WHERE id = :id_pessoa";
            $stmt = $this->pdo->prepare($sqlPessoa);
            $stmt->execute([
                'nome' => $bibliotecario->getNome(),
                'RG' => $bibliotecario->getRG(),
                'CPF' => $bibliotecario->getCPF(),
                'dataNascimento' => $bibliotecario->getDataNascimento()->format('Y-m-d'),
                'email' => $bibliotecario->getEmail(),
                'endereco' => $bibliotecario->getEndereco(),
                'telefone' => $bibliotecario->getTelefone(),
                'id_pessoa' => $bibliotecario->getIdPessoa()
            ]);

            $sqlUsuario = "UPDATE usuario SET
                   login = :login,
                   nivelAcesso = :nivelAcesso,
                   senha = :senha,
                   dataCadastro = :dataCadastro
                   WHERE id = :id_usuario";
            $stmt = $this->pdo->prepare($sqlUsuario);
            $stmt->execute([
                'login' => $bibliotecario->getLogin(),
                'nivelAcesso' => $bibliotecario->getNivelAcesso(),
                'senha' => $bibliotecario->getSenha(),
                'dataCadastro' => $bibliotecario->getDataCadastro()->format('Y-m-d'),
                'id_usuario' => $bibliotecario->getIdUsuario()
            ]);

            $sqlLeitor = "UPDATE bibliotecario SET 
                registroCRB = :registroCRB,
                valorCRB = :valorCRB
                WHERE id = :id";
            $stmtLeitor = $this->pdo->prepare($sqlLeitor);
            $stmtLeitor->execute([
                'id' => $bibliotecario->getId(),
                'registroCRB' => $bibliotecario->getRegistroCRB(),
                'valorCRB' => $bibliotecario->getValorCRB()
            ]);
        }

        public function listAll(){
            $sql = "SELECT b.*, u.id_pessoa, u.login, u.senha, u.nivelAcesso, u.dataCadastro, p.nome, p.RG, p.CPF, p.dataNascimento, p.email, p.endereco, p.telefone from bibliotecario b
            JOIN usuario u on u.id = b.id_usuario
            JOIN pessoa p on p.id = u.id_pessoa";

            $stmt = $this->pdo->query($sql);

            $stmt->execute();
            $arrayAssoBibliotecario = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($arrayAssoBibliotecario as $registroBibliotecario){
                $bibliotecario = new Bibliotecario();
                $bibliotecario->setId($registroBibliotecario['id']);
                $bibliotecario->setIdPessoa($registroBibliotecario['id_pessoa']);
                $bibliotecario->setNome($registroBibliotecario['nome']);
                $bibliotecario->setRG($registroBibliotecario['RG']);
                $bibliotecario->setCPF($registroBibliotecario['CPF']);
                $bibliotecario->setDataNascimento(new DateTime($registroBibliotecario['dataNascimento']));
                $bibliotecario->setEmail($registroBibliotecario['email']);
                $bibliotecario->setEndereco($registroBibliotecario['endereco']);
                $bibliotecario->setTelefone($registroBibliotecario['telefone']);
                $bibliotecario->setLogin($registroBibliotecario['login']);
                $bibliotecario->setSenha($registroBibliotecario['senha']);
                $bibliotecario->setDataCadastro(new DateTime($registroBibliotecario['dataCadastro']));
                $bibliotecario->setNivelAcesso($registroBibliotecario['nivelAcesso']);
                $bibliotecario->setIdUsuario($registroBibliotecario['id_usuario']);
                $bibliotecario->setRegistroCRB($registroBibliotecario['registroCRB']);
                $bibliotecario->setValorCRB($registroBibliotecario['valorCRB']);
                $bibliotecarios []= $bibliotecario;
            }

            return $bibliotecarios;
        }

        public function findByID(int $id){
            $sql = "SELECT b.*, u.id_pessoa, u.login, u.senha, u.nivelAcesso, u.dataCadastro, p.nome, p.RG, p.CPF, p.dataNascimento, p.email, p.endereco, p.telefone from bibliotecario b
            JOIN usuario u on u.id = b.id_usuario
            JOIN pessoa p on p.id = u.id_pessoa
            WHERE b.id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $registroBibliotecario = $stmt->fetch(PDO::FETCH_ASSOC);
            $bibliotecario = new Bibliotecario();
            $bibliotecario->setId($registroBibliotecario['id']);
            $bibliotecario->setIdPessoa($registroBibliotecario['id_pessoa']);
            $bibliotecario->setIdUsuario($registroBibliotecario['id_usuario']);
            $bibliotecario->setNome($registroBibliotecario['nome']);
            $bibliotecario->setRG($registroBibliotecario['RG']);
            $bibliotecario->setCPF($registroBibliotecario['CPF']);
            $bibliotecario->setDataNascimento(new DateTime($registroBibliotecario['dataNascimento']));
            $bibliotecario->setEmail($registroBibliotecario['email']);
            $bibliotecario->setEndereco($registroBibliotecario['endereco']);
            $bibliotecario->setTelefone($registroBibliotecario['telefone']);
            $bibliotecario->setLogin($registroBibliotecario['login']);
            $bibliotecario->setSenha($registroBibliotecario['senha']);
            $bibliotecario->setDataCadastro(new DateTime($registroBibliotecario['dataCadastro']));
            $bibliotecario->setNivelAcesso($registroBibliotecario['nivelAcesso']);
            $bibliotecario->setRegistroCRB($registroBibliotecario['registroCRB']);
            $bibliotecario->setValorCRB($registroBibliotecario['valorCRB']);
            return $bibliotecario;
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

        public function findByRegistroCRB(string $registroCRB){
            $sql = 'SELECT b.*, u.id_pessoa, u.login, u.senha, u.nivelAcesso, u.dataCadastro, p.nome, p.RG, p.CPF, p.dataNascimento, p.email, p.endereco, p.telefone from bibliotecario b
            JOIN usuario u on u.id = b.id_usuario
            JOIN pessoa p on p.id = u.id_pessoa
            WHERE b.registroCRB = :registroCRB';
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['registroCRB' =>$registroCRB]);
            $registroBibliotecario = $stmt->fetch(PDO::FETCH_ASSOC);

            $bibliotecario = new Bibliotecario();
            $bibliotecario->setId($registroBibliotecario['id']);
            $bibliotecario->setIdPessoa($registroBibliotecario['id_pessoa']);
            $bibliotecario->setIdUsuario($registroBibliotecario['id_usuario']);
            $bibliotecario->setNome($registroBibliotecario['nome']);
            $bibliotecario->setRG($registroBibliotecario['RG']);
            $bibliotecario->setCPF($registroBibliotecario['CPF']);
            $bibliotecario->setDataNascimento($registroBibliotecario['dataNascimento']->format('Y-m-d'));
            $bibliotecario->setEmail($registroBibliotecario['email']);
            $bibliotecario->setEndereco($registroBibliotecario['endereco']);
            $bibliotecario->setTelefone($registroBibliotecario['telefone']);
            $bibliotecario->setLogin($registroBibliotecario['login']);
            $bibliotecario->setSenha($registroBibliotecario['senha']);
            $bibliotecario->setDataCadastro(new DateTime($registroBibliotecario['dataCadastro']));
            $bibliotecario->setNivelAcesso($registroBibliotecario['nivelAcesso']);
            $bibliotecario->setRegistroCRB($registroBibliotecario['registroCRB']);
            $bibliotecario->setValorCRB($registroBibliotecario['valorCRB']);
            
            return $bibliotecario;
        }

        public function delete(Bibliotecario $bibliotecario){
            $sql = "DELETE FROM bibliotecario WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $bibliotecario->getId()
            ]);
        }
    }
?>