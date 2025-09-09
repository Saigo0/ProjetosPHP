<?php 
    class Emprestimo{
        private int $id;
        private int $exemplar_id;
        private int $leitor_id;
        private DateTime $dataEmprestimo;
        private DateTime $dataDevolucao;
        private string $status;
        private string $descricao;

        public function __construct(DateTime $dataEmprestimo, DateTime $dataDevolucao, string $status, string $descricao)
        {
            $this->dataEmprestimo = $dataEmprestimo;
            $this->dataDevolucao = $dataDevolucao;
            $this->status = $status;
            $this->descricao = $descricao;
        }

        public function getId(){
            return $this->id;
        }

        public function getExemplarId(){
            return $this->exemplar_id;
        
        }

        public function getLeitorId(){
            return $this->leitor_id;
        }

        public function setDataEmprestimo(DateTime $dataEmprestimo){
            $this->dataEmprestimo = $dataEmprestimo;
        }

        public function getDataEmprestimo(){
            return $this->dataEmprestimo;
        }

        public function setDataDevolucao(DateTime $dataDevolucao){
            $this->dataDevolucao = $dataDevolucao;
        }

        public function getDataDevolucao(){
            return $this->dataDevolucao;
        }

        public function setStatus(string $status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setDescricao(string $descricao){
            $this->descricao = $descricao;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function __toString()
        {
            return "Id: ".$this->id."/nId do exemplar: ".$this->exemplar_id."/nId do leitor: ".$this->leitor_id."/nData do empréstimo: ".$this->dataEmprestimo."/nData da devolução: ".$this->dataDevolucao."/nStatus: ".$this->dataEmprestimo."/nDescrição: ".$this->descricao;
        }

    }
