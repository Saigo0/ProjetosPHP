<?php 
    require_once 'DAO/LivroDAO.php';
    require_once 'model/Livro.php';

    class LivroController{

        public function criarLivro(){
            $livro = new Livro();
            $livro->setTitulo($POST['titulo']);
            $livro->setISBN($POST['ISBN']);
            $livro->setAutor($POST['autor']);
            $livro->setEditora($POST['editora']);
            $livro->setAnoEdicao($POST['anoEdicao']);
            $livro->setNumPaginas($POST['numPaginas']);

            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livroDAO->create($livro);
        }

        public function atualizarLivro(){
            $livro = new Livro();
            $livro->setTitulo($POST['titulo']);
            $livro->setISBN($POST['ISBN']);
            $livro->setAutor($POST['autor']);
            $livro->setEditora($POST['editora']);
            $livro->setAnoEdicao($POST['anoEdicao']);
            $livro->setNumPaginas($POST['numPaginas']);

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

            $livro->setID($livroDAO->findByID($POST['id']));
            
            $livroDAO->delete($livro);
        }


    }


?>