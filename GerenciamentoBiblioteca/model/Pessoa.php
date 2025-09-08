<?php 
    class Pessoa{
        private int $id;
        private string $nome;
        private string $RG;
        private string $CPF;
        private DateTime $dataNascimento;
        private string $email;
        private string $endereco;
        private string $telefone;
        
        public function __construct(string $nome, string $RG, string $CPF, DateTime $dataNascimento, string $email, string $endereco, string $telefone)
        {
            $this->nome = $nome;
            $this->RG = $RG;
            $this->CPF = $CPF;
            $this->dataNascimento = $dataNascimento;
            $this->email = $email;
            $this->endereco = $endereco;
            $this->telefone = $telefone;
        }

        public function getId(){
            return $this-> id;
        }

        public function setNome(string $nome){
            $this->nome = $nome;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setRG(string $RG){
            $this->RG = $RG;
        }

        public function getRG(){
            return $this->RG;
        }

        public function setCPF(string $CPF){
            $this->CPF = $CPF;
        }

        public function getCPF(){
            return $this->CPF;
        }

        public function setDataNascimento(DateTime $dataNascimento){
            $this->dataNascimento = $dataNascimento;
        } 

        public function getDataNascimento(){
            return $this-> dataNascimento;
        }

        public function setEmail(string $email){
           $this->email = $email; 
        }

        public function getEmail(){
            return $this-> email;
        }

        public function setEndereco(string $endereco){
            $this->endereco = $endereco;
        }

        public function getEndereco(){
            return $this-> endereco;
        }

        public function setTelefone(string $telefone){
            $this->telefone = $telefone;
        }

        public function __toString(){
            return "Id: " .$this->id. "/nNome: ".$this->nome."/nRG: ".$this->RG."/nCPF: ".$this->CPF."/nData de nascimento: ".$this->dataNascimento.
            "/nEmail: ".$this->email."/nEndereço: ".$this->endereco."/nTelefone: ".$this->telefone;
        }

        
    }
