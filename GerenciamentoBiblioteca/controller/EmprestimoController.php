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
            $emprestimos = $emprestimoDAO->listAll();

            require __DIR__ . '/../view/TelaGerenciarEmprestimos.php';
        }

        
        public function deletarEmprestimo(){
            $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $emprestimo = $emprestimoDAO->findByID($_GET['id']);
            if ($emprestimo) {
                $service = new EmprestimoService();
                $service->devolverEmprestimo($emprestimo); 
                $emprestimoDAO->delete($emprestimo);       
            }
            header("Location: ../public/index.php?action=gerenciaremprestimos");
            exit;
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
        
        public function devolverEmprestimo() {
            try {
                $id = $_GET['id'] ?? $_POST['id'] ?? null;
                if (!$id) {
                    throw new InvalidArgumentException("ID do empréstimo não informado.");
                }
                $emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
                $emprestimo = $emprestimoDAO->findByID((int)$id);

                $service = new EmprestimoService();
                $service->devolverEmprestimo($emprestimo);

                header("Location: ../public/index.php?action=gerenciaremprestimos");
                exit;
            } catch (InvalidArgumentException $e) {
                header("Location: ../public/index.php?action=gerenciaremprestimos&erro=" . urlencode($e->getMessage()));
                exit;
            }
        }
    }

