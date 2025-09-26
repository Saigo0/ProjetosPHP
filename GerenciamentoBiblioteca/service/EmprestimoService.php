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

        public function realizarEmprestimo(Leitor $leitor, array $listaExemplares){
            if(!$leitor->getMultasPendentes()){
                $dataEmprestimo = new DateTime();
                $dataDevolucao = (clone $dataEmprestimo)->add(new DateInterval('P7D'));
                if($listaExemplares != null && $leitor != null){
                    $emprestimo = new Emprestimo();
                    foreach($listaExemplares as $exemplar){
                        if($exemplar->isDisponivel()){
                            $itemEmprestimo = new ItemEmprestimo();
                            $itemEmprestimo->setExemplar($exemplar);
                            $itemEmprestimo->getExemplar()->setStatus("Emprestado");
                            $this->exemplarDAO->update($exemplar);
                            $emprestimo->addItemEmprestimo($itemEmprestimo);
                        } else
                            throw new InvalidArgumentException("Exemplar não disponível");   
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
                $dataAtual = new DateTime();
                $leitorEmprestimo = $this->leitorDAO->findByID($emprestimo->getLeitor()->getId());
                if($dataAtual > $emprestimo->getDataDevolucao()){
                    $leitorEmprestimo->setMultasPendentes(true);
                    $this->leitorDAO->update($leitorEmprestimo);
                }
                foreach($emprestimo->getItensEmprestimo() as $itemEmprestimo){
                    $itemEmprestimo->getExemplar()->setStatus("Disponivel");
                    $this->exemplarDAO->update($itemEmprestimo->getExemplar());
                }
                $emprestimo->setStatus("Concluído");
                $this->emprestimoDAO->update($emprestimo);
            } else{
                throw new InvalidArgumentException("Não há como realizar a devolução de um empréstimo nulo");
            }
        }

    }
