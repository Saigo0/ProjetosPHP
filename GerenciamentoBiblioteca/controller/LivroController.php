<?php 
    require_once __DIR__ . '/../bootstrap.php';

    class LivroController{

        public function criarLivro(){
            $livro = new Livro();
            $livro->setTitulo($_POST['titulo']);
            $livro->setISBN($_POST['ISBN']);
            $livro->setAutor($_POST['autor']);
            $livro->setEditora($_POST['editora']);
            $livro->setAnoEdicao($_POST['anoEdicao']);
            $livro->setNumPaginas($_POST['numPaginas']);

            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livroDAO->create($livro);

            header("Location: ../view/TelaCadastrarLivro.php");
            exit;
        }

        public function telaCadastrarLivro(){
            require __DIR__ . '/../view/TelaCadastrarLivro.php';
        }

        public function atualizarLivro(){
            $livro = new Livro();
            $livro->setTitulo($_POST['titulo']);
            $livro->setISBN($_POST['ISBN']);
            $livro->setAutor($_POST['autor']);
            $livro->setEditora($_POST['editora']);
            $livro->setAnoEdicao($_POST['anoEdicao']);
            $livro->setNumPaginas($_POST['numPaginas']);

            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livroDAO->update($livro);
        }

        public function listarLivros(){
            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livros = $livroDAO->listAll();
            return $livros;
        }

        public function deletar(){
            $livro = new Livro();
            
            $livroDAO = new LivroDAO(Conexao::getPDO());

            $livro->setID($livroDAO->findByID($_POST['id'])->getId());
            
            $livroDAO->delete($livro);
        }


    }


?>