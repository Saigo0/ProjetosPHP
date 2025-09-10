<?php 

    class UsuarioDAO{

        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Usuario $usuario){
            $sqlPessoa = "INSERT INTO pessoa (nome, RG, CPF, dataNascimento, email, endereco, telefone) VALUES (:nome, :RG, :CPF, :dataNascimento, :email, endereco, telefone)";

            $stmt = $this->pdo->prepare($sqlPessoa);
            $stmt->execute([
                'nome' => $usuario->getNome(),
                'RG' => $usuario->getNome(),
                'CPF' => $usuario->getCPF(),
                'dataNascimento' => $usuario->getDataNascimento(),
                'email' => $usuario->getEmail(),
                'endereco' => $usuario->getEndereco(),
                'telefone' => $usuario->getTelefone()
            ]);

            $idPessoa = $this->pdo->lastInsertId();
            
            $sqlUsuario = "INSERT INTO usuario (login, nivelAcesso, senha, dataCadastro) VALUES (:login, :nivelAcesso, :senha, :dataCadastro)";

            $stmt = $this->pdo->prepare($sqlUsuario);
            $stmt ->execute([
                

            ]);
        }

    }

?>