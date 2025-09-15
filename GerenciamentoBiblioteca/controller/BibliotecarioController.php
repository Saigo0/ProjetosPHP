<?php 
    class BibliotecarioController{
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
            $bibliotecarioDAO->create($bibliotecario);
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