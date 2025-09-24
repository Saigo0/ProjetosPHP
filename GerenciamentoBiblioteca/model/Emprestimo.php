<?php 
    class Emprestimo{
        private int $id;
        private array $itensEmprestimo;
        private Leitor $leitor;
        private DateTime $dataEmprestimo;
        private DateTime $dataDevolucao;
        private string $status;
        private string $descricao;

        public function __construct()
        {
            $this->dataEmprestimo = new DateTime();
            $this->itensEmprestimo = [];

        }

        public function setId(int $id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function getIdItemEmprestimo(){
            
        }

        public function setIdItemEmprestimo(){

        }

        public function getItensEmprestimo(){
            return $this->itensEmprestimo;
        }

        public function setItensEmprestimo(array $itensEmprestimo){
            $this->itensEmprestimo = $itensEmprestimo;
        }

        public function addItemEmprestimo(ItemEmprestimo $itemEmprestimo){
            $this->itensEmprestimo [] = $itemEmprestimo;
        }

        public function removeItemEmprestimo(ItemEmprestimo $itemEmprestimo){
            foreach($this->itensEmprestimo as $key => $item){
                if($item->getId == $itemEmprestimo->getId()){
                    unset($this->itensEmprestimo[$key]);
                    break;
                }
            }
            $this->itensEmprestimo = array_values($this->itensEmprestimo);
        }

        public function setLeitor(Leitor $leitor){
            $this->leitor = $leitor;
        }

        public function getLeitor(){
            return $this->leitor;
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
            return "Id: ".$this->id."/nItens do empréstimo: ".$this->itensEmprestimo."/nLeitor: ".$this->leitor."/nData do empréstimo: ".$this->dataEmprestimo."/nData da devolução: ".$this->dataDevolucao."/nStatus: ".$this->dataEmprestimo."/nDescrição: ".$this->descricao;
        }

    }
