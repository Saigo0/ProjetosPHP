<?php 
    class EmprestimoService{
        private EmprestimoDAO $emprestimoDAO;
        private ExemplarDAO $exemplarDAO;
        private LivroDAO $livroDAO;
        private LeitorDAO $leitorDAO;

        public function __construct()
        {
            $this->emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $this->exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $this->livroDAO = new LivroDAO(Conexao::getPDO());
            $this->leitorDAO = new LeitorDAO(Conexao::getPDO());
        }

        
        public function realizarEmprestimo(Leitor $leitor, array $listaLivros){
            if(!$leitor->getMultasPendentes()){
                $leitor->setMultasPendentes(true);
                $this->leitorDAO->update($leitor);
                $dataEmprestimo = new DateTime();
                $dataDevolucao = (clone $dataEmprestimo)->add(new DateInterval('P7D'));
                if($listaLivros != null && $leitor != null){
                    $emprestimo = new Emprestimo();
                    foreach($listaLivros as $livro){
                        var_dump($livro->getTitulo(), $livro->getExemplares());
                        $exemplarAdicionado = false;
                        foreach($livro->getExemplares() as $exemplar){
                                var_dump($exemplar->getStatus(), $exemplar->isDisponivel());
                            if($exemplar->isDisponivel()){
                                $itemEmprestimo = new ItemEmprestimo();
                                $itemEmprestimo->setExemplar($exemplar);
                                $itemEmprestimo->getExemplar()->setStatus("EMPRESTADO");
                                $this->exemplarDAO->update($exemplar);
                                $emprestimo->addItemEmprestimo($itemEmprestimo);
                                $exemplarAdicionado = true;
                                break;
                            }
                        }
                        if (!$exemplarAdicionado) {
                            throw new InvalidArgumentException("Nenhum exemplar disponível para o livro: " . $livro->getTitulo());
                        }
                    }
                    $emprestimo->setLeitor($leitor);
                    $emprestimo->setDataEmprestimo($dataEmprestimo);
                    $emprestimo->setDataDevolucao($dataDevolucao);
                    $emprestimo->setStatus("Em andamento");
                    $emprestimo->setDescricao("");

                    $this->emprestimoDAO->create($emprestimo);
                } else
                    throw new InvalidArgumentException("Lista de exemplares ou leitor vazios ou nulos");   
            } else
                throw new InvalidArgumentException("O leitor possui multas pendentes, não é possível realizar o empréstimo");
        }

        public function devolverEmprestimo(Emprestimo $emprestimo){
            if($emprestimo != null){
                if($emprestimo->getStatus() != "Concluído"){
                    $dataAtual = new DateTime();
                    $leitorEmprestimo = $this->leitorDAO->findByID($emprestimo->getLeitor()->getId());
                    $leitorEmprestimo->setMultasPendentes(false);
                    $this->leitorDAO->update($leitorEmprestimo);
                    foreach($emprestimo->getItensEmprestimo() as $itemEmprestimo){
                        $itemEmprestimo->getExemplar()->setStatus("DISPONIVEL");
                        $this->exemplarDAO->update($itemEmprestimo->getExemplar());
                    }
                    if($emprestimo->getStatus() != "Concluído"){
                        $emprestimo->setDataDevolucao($dataAtual);
                        $emprestimo->setStatus("Concluído");
                    }
                    $this->emprestimoDAO->update($emprestimo);
                } else{
                    
                }
            } else{
                throw new InvalidArgumentException("Não há como realizar a devolução de um empréstimo nulo");
            }
        }

    }
