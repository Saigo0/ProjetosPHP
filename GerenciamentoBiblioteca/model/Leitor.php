<?php 
    class Leitor extends Usuario{

        private int $id_usuario;
        private bool $multasPendentes;
        private array $emprestimos = [];
        
        public function __construct()
        {
            $this->setDataCadastro(new DateTime());
        }

        public function setIdUsuario(int $id_usuario){
            $this->id_usuario = $id_usuario;
        }

        public function addEmprestimo(Emprestimo $emprestimo){
            $this->emprestimos += $emprestimo;
        }

        public function removeEmprestimo(int $index){
            unset($emprestimos[$index]);
        }

        public function getEmprestimos(){
            return $this->emprestimos;
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
