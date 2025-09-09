<?php 
    class Exemplar{
        private int $id;
        private string $codigo_exemplar;
        private int $livro_id;
        private string $status;

        public function __construct(string $codigo_exemplar, string $status)
        {
            $this->codigo_exemplar = $codigo_exemplar;
            $this->status = $status;
        }

        public function getCodigoExemplar(){
            return $this->codigo_exemplar;
        }

        public function setSatus(string $status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }

        public function __toString()
        {
            return "Id: ".$this->id."/nCódigo de exemplar: ".$this->codigo_exemplar."/nId do livro correspondente: ".$this->livro_id."/nStatus do exemplar".$this->status;
        }
    }
?>