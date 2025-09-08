<?php 
    class Administrador extends Usuario{
        public function __construct(string $nome, string $RG, string $CPF, DateTime $dataNascimento, string $email, string $endereco, string $telefone, string $login, string $nivelAcesso, string $senha, DateTime $dataCadastro)
        {
            parent::__construct( $nome,  $RG,  $CPF, $dataNascimento,  $email,  $endereco,  $telefone,  $login,  $nivelAcesso,  $senha, $dataCadastro);
        }

        public function __toString()
        {
            return parent::__toString();
        }
    }