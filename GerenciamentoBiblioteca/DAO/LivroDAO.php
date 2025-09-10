<?php 
    class LivroDAO{
        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Livro $livro){
            $sql = "INSERT INTO livro (ISBN, titulo, autor, editora, anoEdicao, numPaginas, localEdicao) VALUES (:ISBN, :titulo, :autor, :editora,  :anoEdicao, :numPaginas, :localEdicao)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'ISBN' => $livro->getISBN(),
                'titulo' => $livro->getTitulo(),
                'autor' => $livro->getAutor(),
                'editora' => $livro->getEditora(),
                'anoEdicao' => $livro->getAnoEdicao()
            ]);
        }

        public function listAll(){
            $sql = "SELECT * FROM livro";
            $stmt = $this->pdo->query($sql);

            $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $livros;
        }

        public function delete(Livro $livro){
            $sql = "DELETE FROM livro WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $livro->getId()
            ]);
        }

        public function update(Livro $livro){
        }
    }