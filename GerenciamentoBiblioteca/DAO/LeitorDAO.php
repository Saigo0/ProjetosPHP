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
            $sqlPessoa = "INSERT INTO pessoa (nome, RG, CPF, dataNascimento, email, endereco, telefone) VALUES (:nome, :RG, :CPF, :dataNascimento, :email, :endereco, :telefone)";

            $stmt = $this->pdo->prepare($sqlPessoa);
            $stmt->execute([
                'nome' => $leitor->getNome(),
                'RG' => $leitor->getRG(),
                'CPF' => $leitor->getCPF(),
                'dataNascimento' => $leitor->getDataNascimento()->format('Y-m-d'),
                'email' => $leitor->getEmail(),
                'endereco' => $leitor->getEndereco(),
                'telefone' => $leitor->getTelefone()
            ]);

            $idPessoa = (int)$this->pdo->lastInsertId();
            $leitor->setIdPessoa($idPessoa);
            
            $sqlUsuario = "INSERT INTO usuario (id_pessoa, login, nivelAcesso, senha, dataCadastro) VALUES (:id_pessoa, :login, :nivelAcesso, :senha, :dataCadastro)";

            $stmt = $this->pdo->prepare($sqlUsuario);
            $stmt ->execute([
                'id_pessoa' => $leitor->getIdPessoa(),
                'login' => $leitor->getLogin(),
                'nivelAcesso' => $leitor->getNivelAcesso(),
                'senha' => $leitor->getSenha(),
                'dataCadastro' => $leitor->getDataCadastro()->format('Y-m-d')
            ]);

            $idUsuario = (int)$this->pdo->lastInsertId();
            $leitor->setIdUsuario($idUsuario);

            $sqlLeitor = "INSERT INTO leitor (id_usuario, multasPendentes) VALUES (:id_usuario, :multasPendentes)";
            $stmt = $this->pdo->prepare($sqlLeitor);
            $stmt->execute([
                'id_usuario' => $leitor->getIdUsuario(),
                'multasPendentes' => $leitor->getMultasPendentes() ? 1 : 0
            ]);

            return $this->pdo->lastInsertId();
        }

        public function update(Leitor $leitor){

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
                'nome' => $leitor->getNome(),
                'RG' => $leitor->getRG(),
                'CPF' => $leitor->getCPF(),
                'dataNascimento' => $leitor->getDataNascimento()->format('Y-m-d'),
                'email' => $leitor->getEmail(),
                'endereco' => $leitor->getEndereco(),
                'telefone' => $leitor->getTelefone(),
                'id_pessoa' => $leitor->getIdPessoa()
            ]);

            $sqlUsuario = "UPDATE usuario SET
                   login = :login,
                   nivelAcesso = :nivelAcesso,
                   senha = :senha,
                   dataCadastro = :dataCadastro
                   WHERE id = :id_usuario";
            $stmt = $this->pdo->prepare($sqlUsuario);
            $stmt->execute([
                'login' => $leitor->getLogin(),
                'nivelAcesso' => $leitor->getNivelAcesso(),
                'senha' => $leitor->getSenha(),
                'dataCadastro' => $leitor->getDataCadastro()->format('Y-m-d'),
                'id_usuario' => $leitor->getIdUsuario()
            ]);

            $sqlLeitor = "UPDATE leitor SET 
                multasPendentes = :multasPendentes
                WHERE id = :id";
            $stmtLeitor = $this->pdo->prepare($sqlLeitor);
            $stmtLeitor->execute([
                'id' => $leitor->getId(),
                'multasPendentes' => $leitor->getMultasPendentes() ? 1 : 0
            ]);
        }

        public function listAll(){
            $sql = "SELECT l.*, u.id_pessoa, u.login, u.senha, u.nivelAcesso, u.dataCadastro, p.nome, p.RG, p.CPF, p.dataNascimento, p.email, p.endereco, p.telefone from leitor l
            JOIN usuario u on u.id = l.id_usuario
            JOIN pessoa p on p.id = u.id_pessoa";

            $stmt = $this->pdo->query($sql);
            
            $arrayAsso = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $leitores = [];

            foreach($arrayAsso as $registroLeitor){
                $leitor = new Leitor();
                $leitor->setId($registroLeitor['id']);
                $leitor->setIdUsuario($registroLeitor['id_usuario']);
                $leitor->setIdPessoa($registroLeitor['id_pessoa']);
                $leitor->setNome($registroLeitor['nome']);
                $leitor->setRG($registroLeitor['RG']);
                $leitor->setCPF($registroLeitor['CPF']);
                $leitor->setDataNascimento(new DateTime($registroLeitor['dataNascimento']));
                $leitor->setEmail($registroLeitor['email']);
                $leitor->setEndereco($registroLeitor['endereco']);
                $leitor->setTelefone($registroLeitor['telefone']);
                $leitor->setLogin($registroLeitor['login']);
                $leitor->setNivelAcesso($registroLeitor['nivelAcesso']);
                $leitor->setSenha($registroLeitor['senha']);
                $leitor->setDataCadastro(new DateTime($registroLeitor['dataCadastro']));
                $leitor->setMultasPendentes((bool) $registroLeitor['multasPendentes']);
                $leitores [] = $leitor;
            }
            return $leitores;
        }
        
        public function findByID(int $id){
            

            $sql = "SELECT l.*, u.id_pessoa, u.login, u.senha, u.nivelAcesso, u.dataCadastro, p.nome, p.RG, p.CPF, p.dataNascimento, p.email, p.endereco, p.telefone from leitor l
            JOIN usuario u on u.id = l.id_usuario
            JOIN pessoa p on p.id = u.id_pessoa
            WHERE l.id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $registroLeitor = $stmt->fetch(PDO::FETCH_ASSOC);

            $leitor = new Leitor();
            $leitor->setId($registroLeitor['id']);
            $leitor->setIdPessoa($registroLeitor['id_pessoa']);
            $leitor->setIdUsuario($registroLeitor['id_usuario']);
            $leitor->setNome($registroLeitor['nome']);
            $leitor->setRG($registroLeitor['RG']);
            $leitor->setCPF($registroLeitor['CPF']);
            $leitor->setDataNascimento(new DateTime($registroLeitor['dataNascimento']));
            $leitor->setEmail($registroLeitor['email']);
            $leitor->setEndereco($registroLeitor['endereco']);
            $leitor->setTelefone($registroLeitor['telefone']);
            $leitor->setLogin($registroLeitor['login']);
            $leitor->setSenha($registroLeitor['senha']);
            $leitor->setDataCadastro(new DateTime($registroLeitor['dataCadastro']));
            $leitor->setNivelAcesso($registroLeitor['nivelAcesso']);
            $leitor->setMultasPendentes((bool) $registroLeitor['multasPendentes']);
            
            return $leitor;
        }

        public function findByIdUsuario(int $id){

            $sql = "SELECT l.*, u.id_pessoa, u.login, u.senha, u.nivelAcesso, u.dataCadastro, p.nome, p.RG, p.CPF, p.dataNascimento, p.email, p.endereco, p.telefone from leitor l
            JOIN usuario u on u.id = l.id_usuario
            JOIN pessoa p on p.id = u.id_pessoa
            WHERE u.id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $registroLeitor = $stmt->fetch(PDO::FETCH_ASSOC);

            $leitor = new Leitor();
            
            $leitor->setId($registroLeitor['id']);
            $leitor->setIdPessoa($registroLeitor['id_pessoa']);
            $leitor->setIdUsuario($registroLeitor['id_usuario']);
            $leitor->setNome($registroLeitor['nome']);
            $leitor->setRG($registroLeitor['RG']);
            $leitor->setCPF($registroLeitor['CPF']);
            $leitor->setDataNascimento(new DateTime($registroLeitor['dataNascimento']));
            $leitor->setEmail($registroLeitor['email']);
            $leitor->setEndereco($registroLeitor['endereco']);
            $leitor->setTelefone($registroLeitor['telefone']);
            $leitor->setLogin($registroLeitor['login']);
            $leitor->setSenha($registroLeitor['senha']);
            $leitor->setDataCadastro(new DateTime($registroLeitor['dataCadastro']));
            $leitor->setNivelAcesso($registroLeitor['nivelAcesso']);
            $leitor->setMultasPendentes((bool) $registroLeitor['multasPendentes']);
            
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
            $sql = "DELETE p FROM pessoa p
                    JOIN usuario u on u.id_pessoa = p.id
                    JOIN leitor l on l.id_usuario = u.id
                    WHERE l.id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $leitor->getId()]);
        }


    }
?>