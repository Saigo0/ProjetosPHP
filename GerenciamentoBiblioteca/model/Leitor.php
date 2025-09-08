<?php 
    class Leitor extends Usuario{
        private bool $multasPendentes;
        
        public function __construct(bool $multasPendentes, string $nome, string $RG, string $CPF, DateTime $dataNascimento, string $email, string $endereco, string $telefone, string $login, string $nivelAcesso, string $senha, DateTime $dataCadastro)
        {
            parent::__construct( $nome,  $RG,  $CPF, $dataNascimento,  $email,  $endereco,  $telefone,  $login,  $nivelAcesso,  $senha, $dataCadastro);
            $this->multasPendentes = $multasPendentes;
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
