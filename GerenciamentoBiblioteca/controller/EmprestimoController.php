<?php 
    class EmprestimoController{
        public function criarEmprestimo() {
            $emprestimo = new Emprestimo();
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $emprestimo->setIdItemEmprestimo($_POST['id_item_emprestimo']);
            $emprestimo->setIdLeitor($_POST['id_leitor']);
            $emprestimo->setDataDevolucao($_POST['dataDevolucao']);
            $emprestimo->setStatus($_POST['status']);
            $emprestimo->setDescricao($_POST['descricao']);
            $emprestimoDAO->create($emprestimo);
        }

        public function atualizarEmprestimo(){
            $emprestimo = new Emprestimo();
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $emprestimo->setIdItemEmprestimo($_POST['id_item_emprestimo']);
            $emprestimo->setIdLeitor($_POST['id_leitor']);
            $emprestimo->setDataDevolucao($_POST['dataDevolucao']);
            $emprestimo->setStatus($_POST['stauts']);
            $emprestimo->setDescricao($_POST['descricao']);
            $emprestimoDAO->update($emprestimo);
        }

        public function listarEmprestimos(){
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $arrayAsso = $emprestimoDAO->listAll();

            $emprestimos = [];
            foreach($arrayAsso as $registroEmprestimo){
                $emprestimo = new Emprestimo();
                $emprestimo->setId($registroEmprestimo['id']);
                $emprestimo->setIdItemEmprestimo($registroEmprestimo['id_item_emprestimo']);
                $emprestimo->setIdLeitor($registroEmprestimo['id_leitor']);
                $emprestimo->setDataEmprestimo($registroEmprestimo['dataEmprestimo']);
                $emprestimo->setDataDevolucao($registroEmprestimo['dataDevolucao']);
                $emprestimo->setStatus($registroEmprestimo['status']);
                $emprestimo->setDescricao($registroEmprestimo['descricao']);

                $emprestimos [] = $emprestimo;
            }

            return $emprestimos;
        }

        public function realizarEmprestimo(){
            $leitor = new Leitor();
            $leitor->setId($_POST['id']);
            if(!$leitor->getMultasPendentes()){
                $this->criarEmprestimo();
            }
        }

        public function deletarEmprestimo(){
            $emprestimo = new Emprestimo();
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $emprestimo->setId($emprestimoDAO->findByID($_POST['id']));
            $emprestimoDAO->delete($emprestimo);
        }
    }

