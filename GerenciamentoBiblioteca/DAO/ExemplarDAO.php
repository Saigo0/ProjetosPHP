<?php 
    class ExemplarDAO{
        private PDO $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Exemplar $exemplar){
            $sql = "INSERT INTO exemplar
                (codigoExemplar, livro_id, status) VALUES (:codigoExemplar, :livro_id, :status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'codigoExemplar' => $exemplar->getCodigoExemplar(),
                'livro_id' => $exemplar->getLivroId(),
                'status' => $exemplar->getStatus()
            ]);    
        }

        public function listAll(){
            $sql = "SELECT * FROM livro";
            $stmt = $this->pdo->query($sql);
            $exemplares = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $exemplares;
        }

        public function update(Exemplar $exemplar){
            $sql = "UPDATE livros SET 
                :codigoExemplar = codigoExemplar,
                :livro_id = livro_id,
                :status = status WHERE id = :id";
            
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                'id' => $exemplar->getId(),
                'codigoExemplar' => $exemplar->getCodigoExemplar(),
                'livro_id' => $exemplar->getLivroId(),
                'status' => $exemplar->getStatus()
            ]);
        }
        
        public function delete(Exemplar $exemplar){
            $sql = "DELETE FROM exemplar WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $exemplar->getId()
            ]);
        }
    }
