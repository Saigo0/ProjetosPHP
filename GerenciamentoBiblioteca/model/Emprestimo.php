<?php 
    class Emprestimo{
        private int $id;
        private int $id_item_emprestimo;
        private int $id_leitor;
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

        public function getIdItemEmprestimo(){
            return $this->id_item_emprestimo;
        }

        public function getIdLeitor(){
            return $this->id_leitor;
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
            return "Id: ".$this->id."/nId do item de empréstimo: ".$this->id_item_emprestimo."/nId do leitor: ".$this->id_leitor."/nData do empréstimo: ".$this->dataEmprestimo."/nData da devolução: ".$this->dataDevolucao."/nStatus: ".$this->dataEmprestimo."/nDescrição: ".$this->descricao;
        }

    }
