<?php 
require_once __DIR__ . '/../bootstrap.php';
    class TelaController{
        public function redirecionarPorNivelAcesso(){
            if(isset($_SESSION['nivelAcesso'])){
                switch($_SESSION['nivelAcesso']){
                    case 'ADMINISTRADOR':
                        header("Location: ../public/index.php?action=telaprincipaladministrador");
                        break;
                    case 'BIBLIOTECARIO':
                        header("Location: ../public/index.php?action=telaprincipalbibliotecario");
                        break;
                    default:
                        echo "Nível de acesso inválido.";
                        break;
                }
            } else {
                header("Location: ../public/index.php?action=login");
                exit;
            }
        }
        public function telaPrincipalAdministrador(){
            require __DIR__ . '/../view/TelaPrincipalAdministrador.php';
        }

        public function telaPrincipalBibliotecario(){
            require __DIR__ . '/../view/TelaPrincipalBibliotecario.php';
        }

        public function telaGerenciarLivros() {
            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livros = $livroDAO->listAll();
        
            require __DIR__ . '/../view/TelaGerenciarLivros.php';
        }

        public function telaRealizarEmprestimo() {
            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livros = $livroDAO->listAll();
        
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitores = $leitorDAO->listAll();
        
            require __DIR__ . '/../view/TelaRealizarEmprestimo.php';
        }

        public function telaGerenciarLeitores(){
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitores = $leitorDAO->listAll();

            require __DIR__ . '/../view/TelaGerenciarLeitores.php';
        }

        public function editarLeitor(){
            $leitor = new Leitor();
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitor->setId($_GET['id']);
            $leitor = $leitorDAO->findByID($leitor->getId());

            require __DIR__ . '/../view/TelaEditarLeitor.php';
        }

        public function editarLivro(){
            $livro = new Livro();
            $livroDAO = new LivroDAO(Conexao::getPDO());
            $livro->setId($_GET['id']);
            $livro = $livroDAO->findByID($livro->getId());

            require __DIR__ . '/../view/TelaEditarLivro.php';
        }

        public function editarExemplar(){
            $exemplar = new Exemplar();
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $exemplar->setId($_GET['id']);
            $exemplar = $exemplarDAO->findById($exemplar->getId());

            require __DIR__ . '/../view/TelaEditarExemplar.php';
        }
    }
