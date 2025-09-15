<?php 
    class Leitor extends Usuario{

        private int $id_usuario;
        private bool $multasPendentes;
        
        public function __construct()
        {
            
        }

        public function setIdUsuario(int $id_usuario){
            $this->id_usuario = $id_usuario;
        }

        public function getIdUsuario(){
            return $this->id_usuario;
        }

        public function setMultasPendentes(bool $multasPendentes){
            $this->multasPendentes = $multasPendentes;
        }

        public function getMultasPendentes(){
            return $this->multasPendentes;
        }

        public function __toString(){
            return parent::__toString()."/nTem multas pendentes? ".$this->multasPendentes;
        }
    }
