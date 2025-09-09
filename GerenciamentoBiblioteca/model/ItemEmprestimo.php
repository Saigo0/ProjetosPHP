<?php 
    class ItemEmprestimo{
        private int $id;
        private Exemplar $exemplar;
        private DateTime $dataDevolucaoEfetiva = null;

        public function __construct(Exemplar $exemplar)
        {
            $this->exemplar = $exemplar;
        }

        public function getExemplar(){
            return $this->exemplar;
        }

    }