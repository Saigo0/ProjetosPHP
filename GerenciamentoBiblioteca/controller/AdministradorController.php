<?php 
    require_once __DIR__ . '/../bootstrap.php';
    class AdministradorController{
        
        public function telaPrincipalAdministrador(){
            require __DIR__ . '/../view/TelaPrincipalAdministrador.php';
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
            $bibliotecario->setDataNascimento(DateTime::createFromFormat('Y-m-d', $_POST['dataNascimento']));
            $bibliotecario->setEmail($_POST['email']);
            $bibliotecario->setEndereco($_POST['endereco']);
            $bibliotecario->setTelefone($_POST['telefone']);
            $bibliotecario->setRegistroCRB($_POST['registroCRB']);
            $bibliotecario->setValorCRB($_POST['valorCRB']);
            $bibliotecario->setLogin($_POST['login']);
            $bibliotecario->setSenha($_POST['senha']);
            $bibliotecario->setNivelAcesso("BIBLIOTECARIO");
            $bibliotecarioDAO->create($bibliotecario);

            header("Location: ../public/index.php?action=gerenciarBibliotecarios");
            exit;
        }

        public function editarBibliotecario(){
            $bibliotecario = new Bibliotecario();
            $bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());
            $bibliotecario->setId($_GET['id']);
            $bibliotecario = $bibliotecarioDAO->findByID($bibliotecario->getId());

            require __DIR__ . '/../view/TelaEditarBibliotecario.php';
        }

        public function atualizarBibliotecario(){
            $bibliotecario = new Bibliotecario();
            $bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());
            $bibliotecario->setId($_POST['id']);
            $bibliotecario->setIdUsuario($bibliotecarioDAO->findByID($bibliotecario->getId())->getIdUsuario());
            $bibliotecario->setIdPessoa($bibliotecarioDAO->findByID($bibliotecario->getId())->getIdPessoa());
            $bibliotecario->setNome($_POST['nome']);
            $bibliotecario->setRG($_POST['RG']);
            $bibliotecario->setCPF($_POST['CPF']);
            $bibliotecario->setDataNascimento(new DateTime($_POST['dataNascimento']));
            $bibliotecario->setEmail($_POST['email']);
            $bibliotecario->setEndereco($_POST['endereco']);
            $bibliotecario->setTelefone($_POST['telefone']);
            $bibliotecario->setRegistroCRB($bibliotecarioDAO->findByID($bibliotecario->getId())->getRegistroCRB());
            $bibliotecario->setValorCRB($bibliotecarioDAO->findByID($bibliotecario->getId())->getValorCRB());
            $bibliotecario->setLogin($bibliotecarioDAO->findByID($bibliotecario->getId())->getLogin());
            $bibliotecario->setSenha($bibliotecarioDAO->findByID($bibliotecario->getId())->getSenha());
            $bibliotecario->setNivelAcesso("BIBLIOTECARIO");

            $bibliotecarioDAO->update($bibliotecario);
            header("Location: ../public/index.php?action=gerenciarbibliotecarios");
            exit;
        }

        public function listarBibliotecarios(){
            $bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());
            $bibliotecarios = $bibliotecarioDAO->listAll();

            require __DIR__ . '/../view/TelaGerenciarBibliotecarios.php';
        }

        public function deletarBibliotecario(){
            $bibliotecario = new Bibliotecario();
            $bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());

            $bibliotecario->setId($bibliotecarioDAO->findByID($_GET['id'])->getId());
            $bibliotecarioDAO->delete($bibliotecario);

            header("Location: ../public/index.php?action=gerenciarBibliotecarios");
            exit;
        }
    }