<?php 
    class Administrador extends Usuario{

        private int $id_usuario;

        public function __construct()
        {
            
        }

        public function setIdUsuario(int $id_usuario){
            $this->id_usuario = $id_usuario;
        }

        public function getIdUsuario(){
            return $this->id_usuario;
        }

        public function __toString()
        {
            return parent::__toString();
        }
    }