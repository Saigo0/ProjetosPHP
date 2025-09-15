<?php 
    class Exemplar{
        private int $id;
        private string $codigoExemplar;
        private int $livro_id;
        private string $status;

        public function __construct()
        {
        
        }

        public function setID(int $id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function getLivroId(){
            return $this->livro_id;
        }

        public function setCodigoExemplar(string $codigoExemplar){
            $this->codigoExemplar = $codigoExemplar;
        }

        public function getCodigoExemplar(){
            return $this->codigoExemplar;
        }

        public function setStatus(string $status){
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