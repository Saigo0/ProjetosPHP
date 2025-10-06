<?php 
    class ExemplarDAO{
        private PDO $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Exemplar $exemplar){
            $sql = "INSERT INTO exemplar
                (codigoExemplar, id_livro, status) VALUES (:codigoExemplar, :id_livro, :status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'codigoExemplar' => $exemplar->getCodigoExemplar(),
                'id_livro' => $exemplar->getLivroId(),
                'status' => $exemplar->getStatus()
            ]);    
        }

        public function listAll(){
            $sql = "SELECT * FROM exemplar";
            $stmt = $this->pdo->query($sql);
            $arrayAsso = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $exemplares = [];

            foreach($arrayAsso as $registroExemplar){
                $exemplar = new Exemplar();
                $exemplar->setID($registroExemplar['id']);
                $exemplar->setCodigoExemplar($registroExemplar['codigoExemplar']);
                $exemplar->setLivroId($registroExemplar['id_livro']);
                $exemplar->setStatus($registroExemplar['status']);
                $exemplares []= $exemplar;
            }


            return $exemplares;
        }

        public function update(Exemplar $exemplar){
            $sql = "UPDATE exemplar SET 
                codigoExemplar = :codigoExemplar,
                id_livro = :id_livro,
                status = :status WHERE id = :id";
            
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                'id' => $exemplar->getId(),
                'codigoExemplar' => $exemplar->getCodigoExemplar(),
                'id_livro' => $exemplar->getLivroId(),
                'status' => $exemplar->getStatus()
            ]);
        }

        public function findByCodigoExemplar(string $codigoExemplar){
            $sql = "SELECT * FROM exemplar WHERE codigoExemplar = :codigoExemplar";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['codigoExemplar' => $codigoExemplar]);
            $registroExemplar = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $exemplar = new Exemplar();
            $exemplar->setID($registroExemplar['id']);
            $exemplar->setCodigoExemplar($registroExemplar['codigoExemplar']);
            $exemplar->setLivroId($registroExemplar['id_livro']);
            $exemplar->setStatus($registroExemplar['status']);
            $exemplares [] = $exemplar; 
            
            return $exemplar;
        }


        public function findByID(int $id){
            $sql = "SELECT * FROM exemplar WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $id
            ]);

            $registroExemplar = $stmt->fetch(PDO::FETCH_ASSOC);

            $exemplar = new Exemplar();
            $exemplar->setID($registroExemplar['id']);
            $exemplar->setLivroId($registroExemplar['id_livro']);
            $exemplar->setCodigoExemplar($registroExemplar['codigoExemplar']);
            $exemplar->setStatus($registroExemplar['status']);
            
            return $exemplar;
        }

        
        public function findByLivroId(int $livroId) {
            $stmt = $this->pdo->prepare("SELECT * FROM exemplar WHERE id_livro = ?");
            $stmt->execute([$livroId]);
            $result = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $exemplar = new Exemplar();
                $exemplar->setID($row['id']);
                $exemplar->setLivroId($row['id_livro']);
                $exemplar->setCodigoExemplar($row['codigoExemplar']);
                $exemplar->setStatus($row['status']);
                $result[] = $exemplar;
            }
            return $result;
        }

        public function findByDisponibilidade(string $status){
            $sql = "SELECT * FROM exemplar WHERE status = :status";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['status' => $status]);
            $arrayAssociativo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $exemplares = [];
            foreach($arrayAssociativo as $registroExemplar){
                $exemplar = new Exemplar();
                $exemplar->setID($registroExemplar['id']);
                $exemplar->setCodigoExemplar($registroExemplar['codigoExemplar']);
                $exemplar->setLivroId($registroExemplar['id_livro']);
                $exemplar->setStatus($registroExemplar['status']);
                $exemplares[] = $exemplar;
            }
            return $exemplares;
        }
        
        public function delete(Exemplar $exemplar){
            $sql = "DELETE FROM exemplar WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $exemplar->getId()
            ]);
        }
    }
