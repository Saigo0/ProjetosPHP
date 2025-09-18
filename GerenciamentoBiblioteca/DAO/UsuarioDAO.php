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

            $idPessoa = $this->pdo->lastInsertId();
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
            $sql = "SELECT * FROM usuario";
            $stmt = $this->pdo->query($sql);

            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            $sql = "SELECT * FROM usuario WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $arrayAsso = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach($arrayAsso as $registroUsuario){
                $usuario->set
            } 
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
            $usuario->setSenha($arrayAssociativo['senha']);
            $usuario->setDataCadastro($arrayAssociativo['dataCadastro']);

            return $usuario;
        }

        public function delete(Usuario $usuario): bool {
            $sql = "DELETE FROM usuario WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id' => $usuario->getId()]);
        }

    


    }

