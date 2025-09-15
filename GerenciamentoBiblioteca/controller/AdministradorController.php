<?php 
    class AdministradorController{
        public function criarAdministrador(){
            $administrador = new Administrador();
            $administradorDAO = new AdministradorDAO(Conexao::getPDO());
            $administrador->setNome($_POST['nome']);
            $administrador->setRG($_POST['RG']);
            $administrador->setCPF($_POST['CPF']);
            $administrador->setDataNascimento($_POST['dataNascimento']);
            $administrador->setEmail($_POST['email']);
            $administrador->setEndereco($_POST['endereco']);
            $administrador->setTelefone($_POST['telefone']);
            $administradorDAO->create($administrador);
        }

        public function atualizarAdministrador(){
            $administrador = new Administrador();
            $administradorDAO = new AdministradorDAO(Conexao::getPDO());
            $administrador->setNome($_POST['nome']);
            $administrador->setRG($_POST['RG']);
            $administrador->setCPF($_POST['CPF']);
            $administrador->setDataNascimento($_POST['dataNascimento']);
            $administrador->setEmail($_POST['email']);
            $administrador->setEndereco($_POST['endereco']);
            $administrador->setTelefone($_POST['telefone']);
            $administradorDAO->update($administrador);
        }

        public function listarAdministradores(){
            $administradorDAO = new AdministradorDAO(Conexao::getPDO());
            return $administradorDAO->listAll();
        }

        public function deletarAdministrador(){
            $administrador = new Administrador();
            $administradorDAO = new AdministradorDAO(Conexao::getPDO());
            $administrador->setId($administradorDAO->findByID($_POST['id']));
        }
    }