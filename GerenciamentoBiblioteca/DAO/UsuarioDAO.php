<?php 

    class UsuarioDAO{

        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Usuario $usuario){
            $sqlPessoa = "INSERT INTO pessoa (nome, RG, CPF, dataNascimento, email, endereco, telefone) VALUES (:nome, :RG, :CPF, :dataNascimento, :email, :endereco, :telefone)";

            $stmt = $this->pdo->prepare($sqlPessoa);
            $stmt->execute([
                'nome' => $usuario->getNome(),
                'RG' => $usuario->getRG(),
                'CPF' => $usuario->getCPF(),
                'dataNascimento' => $usuario->getDataNascimento()->format('Y-m-d'),
                'email' => $usuario->getEmail(),
                'endereco' => $usuario->getEndereco(),
                'telefone' => $usuario->getTelefone()
            ]);

            $idPessoa = (int)$this->pdo->lastInsertId();
            $usuario->setIdPessoa($idPessoa);
            
            $sqlUsuario = "INSERT INTO usuario (id_pessoa, login, nivelAcesso, senha, dataCadastro) VALUES (:id_pessoa, :login, :nivelAcesso, :senha, :dataCadastro)";

            $stmt = $this->pdo->prepare($sqlUsuario);
            $stmt ->execute([
                'id_pessoa' => $usuario->getIdPessoa(),
                'login' => $usuario->getLogin(),
                'nivelAcesso' => $usuario->getNivelAcesso(),
                'senha' => $usuario->getSenha(),
                'dataCadastro' => $usuario->getDataCadastro()->format('Y-m-d')
            ]);

            return $this->pdo->lastInsertId();
        }

        public function listAll(){
            $pessoaDAO = new PessoaDAO(Conexao::getPDO());

            $sql = "SELECT u.* FROM usuario u
                    JOIN pessoa p on p.id = u.id_pessoa";
            $stmt = $this->pdo->query($sql);

            $arrayAsso = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $usuarios = [];
            foreach($arrayAsso as $registroUsuario){
                $usuario = new Usuario();
                $usuario->setId($registroUsuario['id']);
                $usuario->setNome($pessoaDAO->findByID($registroUsuario['id_pessoa'])->getNome());
                $usuario->setRG($pessoaDAO->findByID($registroUsuario['id_pessoa'])->getRG());
                $usuario->setCPF($pessoaDAO->findByID($registroUsuario['id_pessoa'])->getCPF());
                $usuario->setDataNascimento($pessoaDAO->findByID($registroUsuario['id_pessoa'])->getDataNascimento());
                $usuario->setEmail($pessoaDAO->findByID($registroUsuario['id_pessoa'])->getEmail());
                $usuario->setEndereco($pessoaDAO->findByID($registroUsuario['id_pessoa'])->getEndereco());
                $usuario->setTelefone($pessoaDAO->findByID($registroUsuario['id_pessoa'])->getTelefone());
                $usuario->setIdPessoa($registroUsuario['id_pessoa']);
                $usuario->setLogin($registroUsuario['login']);
                $usuario->setNivelAcesso($registroUsuario['nivelAcesso']);
                $usuario->setSenha($registroUsuario['senha']);
                $usuario->setDataCadastro(new DateTime($registroUsuario['dataCadastro']));
                $usuarios [] = $usuario;
            }
            return $usuarios;
        }

        public function update(Usuario $usuario){
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
                'nome' => $usuario->getNome(),
                'RG' => $usuario->getRG(),
                'CPF' => $usuario->getCPF(),
                'dataNascimento' => $usuario->getDataNascimento()->format('Y-m-d'),
                'email' => $usuario->getEmail(),
                'endereco' => $usuario->getEndereco(),
                'telefone' => $usuario->getTelefone(),
                'id_pessoa' => $usuario->getIdPessoa()
            ]);

            $sqlUsuario = "UPDATE usuario SET
                   login = :login,
                   nivelAcesso = :nivelAcesso,
                   senha = :senha,
                   dataCadastro = :dataCadastro
                   WHERE id = :id";
            $stmt = $this->pdo->prepare($sqlUsuario);
            $stmt->execute([
                'login' => $usuario->getLogin(),
                'nivelAcesso' => $usuario->getNivelAcesso(),
                'senha' => $usuario->getSenha(),
                'dataCadastro' => $usuario->getDataCadastro()->format('Y-m-d'),
                'id' => $usuario->getId()
            ]);
        }

        public function findByID(int $id){
            $sql = "SELECT u.id, u.id_pessoa, u.login, u.senha, u.nivelAcesso, u.dataCadastro, p.nome, p.RG, p.CPF, p.dataNascimento, p.email, p.endereco, p.telefone from usuario u
            JOIN pessoa p on p.id = u.id_pessoa
            WHERE u.id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $registroUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

            $usuario = new Usuario();
            $usuario->setId($registroUsuario['id']);
            $usuario->setIdPessoa($registroUsuario['id_pessoa']);
            $usuario->setNome($registroUsuario['nome']);
            $usuario->setRG($registroUsuario['RG']);
            $usuario->setCPF($registroUsuario['CPF']);
            $usuario->setDataNascimento(new DateTime($registroUsuario['dataNascimento']));
            $usuario->setEmail($registroUsuario['email']);
            $usuario->setEndereco($registroUsuario['endereco']);
            $usuario->setTelefone($registroUsuario['telefone']);
            $usuario->setLogin($registroUsuario['login']);
            $usuario->setNivelAcesso($registroUsuario['nivelAcesso']);
            $usuario->setSenhaHash($registroUsuario['senha']);
            $usuario->setDataCadastro(new DateTime($registroUsuario['dataCadastro']));

            return $usuario;
        }

        public function findByLogin(string $login){
            $sql = "SELECT * FROM usuario WHERE login = :login";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['login' => $login]);
            $arrayAssociativo = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$arrayAssociativo){
                return null;
            }
            
            
                $usuario = new Usuario();
                $usuario->setId($arrayAssociativo['id']);
                $usuario->setIdPessoa($arrayAssociativo['id_pessoa']);
                $usuario->setNivelAcesso($arrayAssociativo['nivelAcesso']);
                $usuario->setLogin($arrayAssociativo['login']);
                $usuario->setSenhaHash($arrayAssociativo['senha']);
                $usuario->setDataCadastro(new DateTime($arrayAssociativo['dataCadastro']));
                $usuarios [] = $usuario;
            
    

            return $usuario;
        }

        public function delete(Usuario $usuario): bool {
            $sql = "DELETE p FROM pessoa p
                    JOIN usuario u on u.id_pessoa = p.id
                    WHERE u.id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id' => $usuario->getId()]);
        }

    


    }

