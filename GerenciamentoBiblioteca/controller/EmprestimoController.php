<?php 
    require_once __DIR__ . '/../bootstrap.php';
    class EmprestimoController{
        public function criarEmprestimo() {
            $emprestimo = new Emprestimo();
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $emprestimo->setLeitor($leitorDAO->findByID($_POST['id_leitor']));
            $emprestimo->setDataDevolucao($_POST['dataDevolucao']);
            $emprestimo->setStatus($_POST['status']);
            $emprestimo->setDescricao($_POST['descricao']);
            $emprestimoDAO->create($emprestimo);
        }

        public function atualizarEmprestimo(){
            $emprestimo = new Emprestimo();
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $emprestimo->setLeitor($leitorDAO->findByID($_POST['id_leitor']));
            $emprestimo->setDataDevolucao($_POST['dataDevolucao']);
            $emprestimo->setStatus($_POST['stauts']);
            $emprestimo->setDescricao($_POST['descricao']);
            $emprestimoDAO->update($emprestimo);
        }

        public function listarEmprestimos(){
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $arrayAsso = $emprestimoDAO->listAll();

            $emprestimos = [];
            foreach($arrayAsso as $registroEmprestimo){
                $emprestimo = new Emprestimo();
                $emprestimo->setId($registroEmprestimo['id']);
                $emprestimo->setLeitor($leitorDAO->findByID($registroEmprestimo['id_leitor']));
                $emprestimo->setDataEmprestimo($registroEmprestimo['dataEmprestimo']);
                $emprestimo->setDataDevolucao($registroEmprestimo['dataDevolucao']);
                $emprestimo->setStatus($registroEmprestimo['status']);
                $emprestimo->setDescricao($registroEmprestimo['descricao']);
                $emprestimos [] = $emprestimo;
            }

            return $emprestimos;
        }

        public function deletarEmprestimo(){
            $emprestimo = new Emprestimo();
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $emprestimo->setId($emprestimoDAO->findByID($_POST['id'])->getId());
            $emprestimoDAO->delete($emprestimo);
        }

        public function realizarEmprestimo(){
            $emprestimoService = new EmprestimoService();
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $livroDAO = new LivroDAO(Conexao::getPDO());
            $leitor = $leitorDAO->findByID($_POST['leitor']);
            $idLivros = $_POST['livros'];
            foreach($idLivros as $idLivro){
                $livros[] = $livroDAO->findByID((int)$idLivro);
            }    
            $emprestimoService->realizarEmprestimo($leitor, $livros);

            header('Location: ../public/index.php?action=telaprincipal');
            exit;
        }

        public function devolverEmprestimo(){

        }
    }

