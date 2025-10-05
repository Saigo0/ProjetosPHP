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
            $livro->setLocalEdicao($_POST['localEdicao']);


            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livroDAO->create($livro);

            header("Location: ../public/index.php?action=gerenciarlivros");
            exit;
        }

        public function telaCadastrarLivro(){
            require __DIR__ . '/../view/TelaCadastrarLivro.php';
        }

        public function atualizarLivro(){
            $livro = new Livro();
            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livro->setId($_POST['id']);
            $livro->setTitulo($_POST['titulo']);
            $livro->setISBN($livroDAO->findByID($livro->getId())->getISBN());
            $livro->setAutor($_POST['autor']);
            $livro->setEditora($_POST['editora']);
            $livro->setAnoEdicao($_POST['anoEdicao']);
            $livro->setLocalEdicao($_POST['localEdicao']);

            $livro->setNumPaginas($_POST['numPaginas']);

            
            $livroDAO->update($livro);

            header("Location: ../public/index.php?action=gerenciarlivros");
            exit;
        }

        public function listarLivros(){
            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livros = $livroDAO->listAll();
            return $livros;
        }

        public function deletarLivro(){
            $livro = new Livro();
            
            $livroDAO = new LivroDAO(Conexao::getPDO());

            $livro->setID($livroDAO->findByID($_POST['id'])->getId());
            
            $livroDAO->delete($livro);

            header("Location: ../public/index.php?action=gerenciarlivros");
            exit;
        }


    }


?>