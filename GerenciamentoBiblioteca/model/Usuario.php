<?php 
    class Usuario extends Pessoa{
        private string $login;
        private string $nivelAcesso;
        private string $senha;
        private DateTime $dataCadastro;

        public function __construct(string $nome, string $RG, string $CPF, DateTime $dataNascimento, string $email, string $endereco, string $telefone, string $login, string $nivelAcesso, string $senha, DateTime $dataCadastro)
        {   
            parent::__construct($nome,  $RG,  $CPF, $dataNascimento,  $email,  $endereco,  $telefone);
            $this->login = $login;
            $this->nivelAcesso = $nivelAcesso;
            $this->senha=$senha;
            $this->dataCadastro = $dataCadastro;
        }

        public function setLogin(int $login){
            $this->login = $login;
            return true;
        }

        public function getLogin(){
            return $this->login;
        }

        public function setNivelAcesso(string $nivelAcesso){
            $this->nivelAcesso = $nivelAcesso;
        }

        public function getNivelAcesso(){
            return $this->nivelAcesso;
        }

        public function setSenha(string $senha){
            $this->senha = $senha;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function setDataCadastro(DateTime $dataCadastro){
            $this->dataCadastro = $dataCadastro;
        }

        public function getDataCadastro(){
            return $this->dataCadastro;
        }

        public function __toString(){
            return parent::__toString(). "/nLogin: ".$this->login."/nNível de acesso: ".$this->nivelAcesso."/nSenha: ".$this->senha."/nData de cadastro: ".$this->dataCadastro;
        }


    }