<?php 
    class PessoaDAO{

        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Pessoa $pessoa){
            $sql = "INSERT INTO pessoa (nome, RG, CPF, dataNascimento, email, endereco, telefone) VALUES (:nome, :RG, :CPF, :dataNascimento, :email, endereco, telefone)";

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

        public function listAll(){
            $sql = "SELECT * FROM pessoa";
            $stmt = $this->pdo->query($sql);

            $pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($pessoas as $pessoa){
                echo $pessoa->__toString();
            }
        }

        public function delete(int $id){
            $sql = "DELETE FROM pessoa WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([':id' => $id]);

            echo "Registro removido";
        }   

        public function update(Pessoa $pessoa){
            $sql = "UPDATE Pessoa SET 
                    nome = :nome,
                    RG = :RG,
                    CPF = :CPF,
                    dataNascimento = :dataNascimento,
                    email = :email,
                    endereco = :endereco,
                    telefone = :telefone WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id'=> $pessoa->getId(),
                'nome'=> $pessoa->getNome(),
                'RG' => $pessoa->getRG(),
                'CPF' => $pessoa->getCPF(),
                'dataNascimento' => $pessoa->getDataNascimento(),
                'email' => $pessoa->getEmail(),
                'endereco' => $pessoa->getEndereco(),
                'telefone' => $pessoa->getTelefone()
            ]);
        }

        
    }

?>