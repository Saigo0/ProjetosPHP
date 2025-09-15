<?php 
    class Livro{
        private int $id;
        private string $ISBN;
        private string $titulo;
        private string $autor;
        private string $editora;
        private int $anoEdicao;
        private int $numPaginas;
        private string $localEdicao;

        public function __construct()
        {
        
        }

        public function setID(int $id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function getISBN(){
            return $this->ISBN;
        }

        public function setISBN(int $ISBN){
            $this->ISBN = $ISBN;
        }

        public function setTitulo(string $titulo){
            $this->titulo = $titulo;
        }

        public function getTitulo(){
            return $this->titulo;
        }

        public function setAutor(string $autor){
            $this->autor = $autor;
        }

        public function getAutor(){
            return $this->autor;
        }

        public function setEditora(string $editora){
            $this->editora = $editora;
        }

        public function getEditora(){
            return $this->editora;
        }

        public function setAnoEdicao(int $anoEdicao){
            $this->anoEdicao = $anoEdicao;
        }

        public function getAnoEdicao(){
            return $this->anoEdicao;
        }

        public function setNumPaginas(int $numPaginas){
            $this->numPaginas = $numPaginas;
        }

        public function getNumPaginas(){
            return $this->numPaginas;
        }

        public function setLocalEdicao(string $localEdicao){
            $this->localEdicao = $localEdicao;
        }

        public function getLocalEdicao(){
            return $this->localEdicao;
        }

        public function __toString()
        {
            return "Id: ".$this->id."/nISBN: ".$this->ISBN."/nTítulo: ".$this->titulo."/nAutor: ".$this->autor. "/nEditora: ".$this->editora."/nAno da edição: ".$this->anoEdicao."/nNúmero de páginas: ".$this->numPaginas."/nLocal de edição: ".$this->localEdicao;
        }

    }