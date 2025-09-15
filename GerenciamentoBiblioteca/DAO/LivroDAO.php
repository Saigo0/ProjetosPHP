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
                'anoEdicao' => $livro->getAnoEdicao(),
                'localEdicao' =>$livro->getLocalEdicao()
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

        public function findByID(int $id){
            $sql = "SELECT * FROM livro WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $livro = $stmt->execute(['id' => $id]);
            return $livro;
        }

        public function update(Livro $livro){
            $sql = "UPDATE livro SET 
                ISBN = :ISBN,
                titulo = :titulo,
                autor = :autor,
                editora = :editora,
                anoEdicao = :anoEdicao,
                numPaginas = :numPaginas,
                localEdicao = :localEdicao WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'ISBN' => $livro->getISBN(),
                'titulo' => $livro->getTitulo(),
                'autor' => $livro->getAutor(),
                'editora' => $livro->getEditora(),
                'anoEdicao' => $livro->getAnoEdicao(),
                'numPaginas' => $livro->getNumPaginas(),
                'localEdicao' => $livro->getLocalEdicao(),
                'id' => $livro->getId()
            ]);
        }
    }