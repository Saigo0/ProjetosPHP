<?php 
    class PessoaDAO{
        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Pessoa $pessoa){
            $sql = "INSERT INTO pessoa (nome, RG, CPF, dataNascimento, email, endereco, telefone) VALUES (:nome, :RG, :CPF, :dataNascimento, :email, :endereco, :telefone)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'nome' => $pessoa->getNome(),
                'RG' => $pessoa->getRG(),
                'CPF' => $pessoa->getCPF(),
                'dataNascimento' => $pessoa->getDataNascimento()->format('Y-m-d'),
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
                'dataNascimento' => $pessoa->getDataNascimento()->format('Y-m-d'),
                'email' => $pessoa->getEmail(),
                'endereco' => $pessoa->getEndereco(),
                'telefone' => $pessoa->getTelefone()
            ]);
        }

        public function listAll(){
            $sql = "SELECT * FROM pessoa";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $arrayAsso = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pessoas = [];
            foreach($arrayAsso as $registroPessoa){
                $pessoa = new Pessoa();
                $pessoa->setId($registroPessoa['id']);
                $pessoa->setNome($registroPessoa['nome']);
                $pessoa->setRG($registroPessoa['RG']);
                $pessoa->setCPF($registroPessoa['CPF']);
                $pessoa->setDataNascimento(new DateTime($registroPessoa['dataNascimento']));
                $pessoa->setEmail($registroPessoa['email']);
                $pessoa->setEndereco($registroPessoa['endereco']);
                $pessoa->setTelefone($registroPessoa['telefone']);
                $pessoas [] = $pessoa; 
            }
            return $pessoas;
        }

        public function findByID(int $id){
            $sql = "SELECT * FROM pessoa WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $arrayAsso = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pessoa = new Pessoa();
            foreach($arrayAsso as $registroPessoa){
                $pessoa->setId($registroPessoa['id']);
                $pessoa->setNome($registroPessoa['nome']);
                $pessoa->setRG($registroPessoa['RG']);
                $pessoa->setCPF($registroPessoa['CPF']);
                $pessoa->setDataNascimento(new DateTime($registroPessoa['dataNascimento']));
                $pessoa->setEmail($registroPessoa['email']);
                $pessoa->setEndereco($registroPessoa['endereco']);
                $pessoa->setTelefone($registroPessoa['telefone']);
            }
            return $pessoa;
        }

        public function delete(Pessoa $pessoa){
            $sql = "DELETE FROM pessoa WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $pessoa->getId()]);
        }
    }