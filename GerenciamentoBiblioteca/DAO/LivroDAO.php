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
                'numPaginas' => $livro->getNumPaginas(),
                'localEdicao' =>$livro->getLocalEdicao()
            ]);
        }

        public function listAll(){
            $sql = "SELECT * FROM livro";
            $stmt = $this->pdo->query($sql);

            $arrayAssociativo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $livros = [];

            foreach($arrayAssociativo as $registroLivro){
                $livro = new Livro();
                $livro->setID($registroLivro['id']);
                $livro->setISBN($registroLivro['ISBN']);
                $livro->setTitulo($registroLivro['titulo']);
                $livro->setAutor($registroLivro['autor']);
                $livro->setEditora($registroLivro['editora']);
                $livro->setAnoEdicao($registroLivro['anoEdicao']);
                $livro->setNumPaginas($registroLivro['numPaginas']);
                $livro->setLocalEdicao($registroLivro['localEdicao']);
                $livros[] = $livro;
            }
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
            $stmt->execute(['id' => $id]);
            $registroLivro = $stmt->fetch(PDO::FETCH_ASSOC);

            $livro = new Livro();
            
            $livro->setID($registroLivro['id']);
            $livro->setISBN($registroLivro['ISBN']);
            $livro->setTitulo($registroLivro['titulo']);
            $livro->setAutor($registroLivro['autor']);
            $livro->setEditora($registroLivro['editora']);
            $livro->setAnoEdicao($registroLivro['anoEdicao']);
            $livro->setNumPaginas($registroLivro['numPaginas']);
            $livro->setLocalEdicao($registroLivro['localEdicao']);

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