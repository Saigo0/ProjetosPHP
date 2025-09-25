<?php 
    class ItemEmprestimo{
        private int $id;
        private int $id_emprestimo;
        private Exemplar $exemplar;
       

        public function __construct()
        {
        
        }

        public function setExemplar(Exemplar $exemplar){
            $this->exemplar = $exemplar;
        }

        public function getExemplar(){
            return $this->exemplar;
        }

        public function setId(int $id){
            $this->id = $id; 
        }

        public function getId(){
            return $this->id;
        }

        public function getIdExemplar(){
            return $this->exemplar->getId();
        }

        public function setIdEmprestimo(int $idEmprestimo){
            $this->id_emprestimo = $idEmprestimo;
        }

        public function getIdEmprestimo(){
            return $this->id_emprestimo;
        }

        public function __toString()
        {
            return "ID: " . $this->getId() . "Id do exemplar: " . $this->getExemplar()->getId() . "Id do empréstimo: " .$this->getIdEmprestimo(); 
        }



    }