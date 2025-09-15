<?php 
    class EmprestimoController{
        public function criarEmprestimo() {
            $emprestimo = new Emprestimo();
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());

            $emprestimoDAO->create($emprestimo);
        }

        public function atualizarEmprestimo(){
            $emprestimo = new Emprestimo();
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());

            $emprestimoDAO->update($emprestimo);
        }

        public function listarEmprestimos(){
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            return $emprestimoDAO->listAll();
        }

        public function deletarEmprestimo(){
            $emprestimo = new Emprestimo();
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $emprestimo->setId($emprestimoDAO->findByID($_POST['id']));
            $emprestimoDAO->delete($emprestimo);
        }
    }

