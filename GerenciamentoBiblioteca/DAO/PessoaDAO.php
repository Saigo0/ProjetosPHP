<?php 
    class PessoaDAO{
        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Pessoa $pessoa){
            $sql = "INSERT INTO pessoa (nome, RG, CPF, dataNascimento, email, endereco, telefone) VALUES (:nome, :RG, :CPF, :dataNascimento, :email, : endereco, :telefone)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'nome' => $pessoa->getNome(),
                'RG' => $pessoa->getRG(),
                'CPF' => $pessoa->getCPF(),
                'dataNascimento' => $pessoa->getDataNascimento(),
                'email' => $pessoa->getEmail(),
                'endereco' => $pessoa->getEndereco(),
                'telefone' => $pessoa->getTelefone()
            ]);
        }

        public function update(Pessoa $pessoa){
            $sql = "UPDATE pessoa SET 
                nome = :nome,
                RG = :RG,
                CPF = :CPF,
                dataNascimento = :dataNascimento,
                email = :email,
                endereco = :endereco,
                telefone = :telefone WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $pessoa->getId(),
                'nome' => $pessoa->getNome(),
                'RG' => $pessoa->getRG(),
                'CPF' => $pessoa->getCPF(),
                'dataNascimento' => $pessoa->getDataNascimento(),
                'email' => $pessoa->getEmail(),
                'endereco' => $pessoa->getEndereco(),
                'telefone' => $pessoa->getTelefone()
            ]);
        }

        public function listAll(){
            $sql = "SELECT * FROM pessoa";
            $stmt = $this->pdo->prepare($sql);
            $pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $pessoas;
        }

        public function findByID(int $id){
            $sql = "SELECT * FROM pessoa WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $arrayAsso = $stmt->fetch(PDO::FETCH_ASSOC);
            return $arrayAsso;
        }

        public function delete(Pessoa $pessoa){
            $sql = "DELETE FROM pessoa WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $pessoa->getId()]);
        }
    }