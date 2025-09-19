<?php 
    class ItemEmprestimo{
        private int $id;
        private int $id_emprestimo;
        private Exemplar $exemplar;
       

        public function __construct(Exemplar $exemplar)
        {
            $this->exemplar = $exemplar;
        }

        public function getExemplar(){
            return $this->exemplar;
        }

        public function getId(){
            return $this->id;
        }

        public function getIdEmprestimo(){
            return $this->id_emprestimo;
        }



    }