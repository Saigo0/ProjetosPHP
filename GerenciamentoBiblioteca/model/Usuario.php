<?php 
    require_once "Pessoa.php";
    class Usuario extends Pessoa{

        private int $id_pessoa;
        private string $login;


        private string $nivelAcesso;
        private string $senha;
        private DateTime $dataCadastro;

        public function __construct()
        {
            
        }
        

        public function setLogin(string $login){
            $this->login = $login;
            return true;
        }

        public function getIdPessoa(): int
        {
            return $this->id_pessoa;
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
            if(strlen($senha) < 8){
                throw new InvalidArgumentException("A senha deve ter ao menos 8 caracteres");
            } else{
                $this->senha = password_hash($senha, PASSWORD_DEFAULT);
            }

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

        public function setIdPessoa(int $id_pessoa)
        {
            $this->id_pessoa = $id_pessoa;
        }


    }