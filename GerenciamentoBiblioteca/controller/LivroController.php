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
            $arrayAsso = $livroDAO->listAll();
            $livros = [];
            foreach($arrayAsso as $registroLivro){
                
                $livro = new Livro();
                $livro->setID($registroLivro['id']);
                $livro->setISBN($registroLivro['ISBN']);
                $livro->setTitulo($registroLivro['titulo']);
                $livro->setAutor($registroLivro['autor']);
                $livro->setEditora($registroLivro['editora']);
                $livro->setAnoEdicao($registroLivro['anoEdicao']);
                $livro->setNumPaginas($registroLivro['numPaginas']);
                $livro->setLocalEdicao($registroLivro['localEdicao']);

                $livros [] = $livro;
            }

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