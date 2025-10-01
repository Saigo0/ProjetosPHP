<?php 
    require_once __DIR__ . '/../bootstrap.php';
    class AdministradorController{
        
        public function loginAdministrador(){
            header("Location: ../view/TelaPrincipalAdministrador.php");
            exit;
        }
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

        public function criarBibliotecario(){
            $bibliotecario = new Bibliotecario();
            $bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());
            $bibliotecario->setNome($_POST['nome']);
            $bibliotecario->setRG($_POST['RG']);
            $bibliotecario->setCPF($_POST['CPF']);
            $bibliotecario->setDataNascimento($_POST['dataNascimento']);
            $bibliotecario->setEmail($_POST['email']);
            $bibliotecario->setEndereco($_POST['endereco']);
            $bibliotecario->setTelefone($_POST['telefone']);
            $bibliotecario->setRegistroCRB($_POST['registroCRB']);
            $bibliotecario->setValorCRB($_POST['valorCRB']);
            $bibliotecarioDAO->create($bibliotecario);

            header("Location: ../view/TelaGerenciarBibliotecarios.php");
            exit;
        }

        public function atualizarBibliotecario(){
            $bibliotecario = new Bibliotecario();
            $bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());
            $bibliotecario->setNome($_POST['nome']);
            $bibliotecario->setRG($_POST['RG']);
            $bibliotecario->setCPF($_POST['CPF']);
            $bibliotecario->setDataNascimento($_POST['dataNascimento']);
            $bibliotecario->setEmail($_POST['email']);
            $bibliotecario->setEndereco($_POST['endereco']);
            $bibliotecario->setTelefone($_POST['telefone']);
            $bibliotecarioDAO->update($bibliotecario);
        }

        public function listarBilbiotecarios(){
            $bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());
            return $bibliotecarioDAO->listAll();
        }

        public function deletarBibliotecario(){
            $bibliotecario = new Bibliotecario();
            $bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());

            $bibliotecario->setId($bibliotecarioDAO->findByID($_POST['id']));
            $bibliotecarioDAO->delete($bibliotecario);
        }
    }