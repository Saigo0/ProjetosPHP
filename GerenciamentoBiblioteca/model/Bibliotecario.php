<?php 
    class Bibliotecario extends Usuario{
        private string $registroCRB;
        private float $valorCRB;

        public function __construct(string $registroCRB, string $valorCRB, string $nome, string $RG, string $CPF, DateTime $dataNascimento, string $email, string $endereco, string $telefone, string $login, string $nivelAcesso, string $senha, DateTime $dataCadastro)
        {
            parent::__construct($nome, $RG, $CPF, $dataNascimento, $email, $endereco, $telefone, $login, $nivelAcesso, $senha, $dataCadastro);
            $this->registroCRB = $registroCRB;
            $this->valorCRB = $valorCRB;
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