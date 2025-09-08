<?php 
    class Bibliotecario extends Usuario{
        private string $registroCRB;
        private float $valorCRB;
        private array $especializacoes;

        public function __construct(string $registroCRB, string $valorCRB, array $especializacoes, string $nome, string $RG, string $CPF, DateTime $dataNascimento, string $email, string $endereco, string $telefone, string $login, string $nivelAcesso, string $senha, DateTime $dataCadastro)
        {
            parent::__construct($nome, $RG, $CPF, $dataNascimento, $email, $endereco, $telefone, $login, $nivelAcesso, $senha, $dataCadastro);
            $this->registroCRB = $registroCRB;
            $this->valorCRB = $valorCRB;
            $this->especializacoes = $especializacoes;
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

        public function getEspecializacoes(){
            return $this->especializacoes;
        }

        public function addEspecializacao(string $especializacao){
            array_push($this->especializacoes, $especializacao);
        }

        public function removeEspecializacao(int $index){
            unset($this->especializacoes[$index]);
        }

        public function __toString()
        {
            parent::__toString()."/nRegistroCRB: ".$this->registroCRB."/nValorCRB: ".$this->valorCRB."/nEspecializações: ".$this->especializacoes;
        }
    }