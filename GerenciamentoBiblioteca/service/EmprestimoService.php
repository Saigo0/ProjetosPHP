<?php 
    class EmprestimoService{
        private EmprestimoDAO $emprestimoDAO;
        private ExemplarDAO $exemplarDAO;
        private LivroDAO $livroDAO;

        public function __construct()
        {
            $this->emprestimoDAO = new EmprestimoDAO(Conexao::getPDO());
            $this->exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $this->livroDAO = new LivroDAO(Conexao::getPDO());
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
                            $emprestimo->addItemEmprestimo($itemEmprestimo);
                            $emprestimo->setLeitor($leitor);
                            $emprestimo->setDataEmprestimo($dataEmprestimo);
                            $emprestimo->setDataDevolucao($dataDevolucao);
                            $emprestimo->setStatus("Em andamento");
                            $emprestimo->setDescricao("");
                            $this->emprestimoDAO->create($emprestimo);
                        } else
                            throw new InvalidArgumentException("Exemplar não disponível");   
                    }
                } else
                    throw new InvalidArgumentException("Lista de exemplares ou leitor vazios ou nulos");   
            }
        }

        public function devolverEmprestimo(Emprestimo $emprestimo){
            if($emprestimo != null){
                
            }
        }

    }
