<?php 
    class Bibliotecario extends Usuario{
        private int $id_usuario;
        private string $registroCRB;
        private float $valorCRB;

        public function __construct()
        {
        
        }

        public function setIdUsuario(int $id_usuario){
            $this->id_usuario = $id_usuario;
        }

        public function getIdUsuario(){
            return $this->id_usuario;
        }

        public function setRegistroCRB(string $registroCRB){
            $this->registroCRB = $registroCRB;
        }

        public function getRegistroCRB(){
            return $this->registroCRB;
        }

        public function setValorCRB(float $valorCRB){
            $this->valorCRB = $valorCRB;
        }

        public function getValorCRB(){
            return $this->valorCRB;
        }

        public function __toString()
        {
            parent::__toString()."/nRegistroCRB: ".$this->registroCRB."/nValorCRB: ".$this->valorCRB;
        }
    }