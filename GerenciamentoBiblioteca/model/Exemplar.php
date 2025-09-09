<?php 
    class Exemplar{
        private int $id;
        private string $codigoExemplar;
        private int $livro_id;
        private string $status;

        public function __construct(string $codigoExemplar, string $status)
        {
            $this->codigoExemplar = $codigoExemplar;
            $this->status = $status;
        }

        public function getCodigoExemplar(){
            return $this->codigoExemplar;
        }

        public function setSatus(string $status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }

        public function __toString()
        {
            return "Id: ".$this->id."/nCódigo de exemplar: ".$this->codigoExemplar."/nId do livro correspondente: ".$this->livro_id."/nStatus do exemplar".$this->status;
        }
    }
?>