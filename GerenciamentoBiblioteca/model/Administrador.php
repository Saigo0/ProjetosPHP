<?php 
    class Administrador extends Usuario{

        private int $id_usuario;

        public function __construct(string $nome, string $RG, string $CPF, DateTime $dataNascimento, string $email, string $endereco, string $telefone, string $login, string $nivelAcesso, string $senha, DateTime $dataCadastro)
        {
            parent::__construct( $nome,  $RG,  $CPF, $dataNascimento,  $email,  $endereco,  $telefone,  $login,  $nivelAcesso,  $senha, $dataCadastro);
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