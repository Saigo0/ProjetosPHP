<?php 
    class LeitorController{
        public function criarLeitor(){
            $leitor = new Leitor();
            $leitor->setNome($_POST['nome']);
            $leitor->setRG($_POST['RG']);
            $leitor->setCPF($_POST['CPF']);
            $leitor->setDataNascimento($_POST['dataNascimento']);
            $leitor->setEmail($_POST['email']);
            $leitor->setEndereco($_POST['endereco']);
            $leitor->setTelefone($_POST['telefone']);
            $leitor->setLogin($_POST['login']);
            $leitor->setSenha($_POST['senha']);

            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitorDAO->create($leitor);
        }

        public function atualizarLeitor(){
            $leitor = new Leitor();

            $leitor->setNome($_POST['nome']);
            $leitor->setRG($_POST['RG']);
            $leitor->setCPF($_POST['CPF']);
            $leitor->setDataNascimento($_POST['dataNascimento']);
            $leitor->setEmail($_POST['email']);
            $leitor->setEndereco($_POST['endereco']);
            $leitor->setTelefone($_POST['telefone']);
            $leitor->setLogin($_POST['login']);
            $leitor->setSenha($_POST['senha']);

            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitorDAO->update($leitor);
        }

        public function listarLeitores(){
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $pessoaDAO = new PessoaDAO(Conexao::getPDO());
            $usuarioDAO = new UsuarioDAO(Conexao::getPDO());
            $leitores =[];
            $arrayAssoLeitor = $leitorDAO->listAll();

            foreach($arrayAssoLeitor as $registroLeitor){
                $leitor = new Leitor();
                $leitor->setId($registroLeitor['id']);
                $leitor->setIdUsuario($usuarioDAO->findByID($registroLeitor['id_usuario']));
                $leitor->setIdPessoa($usuarioDAO->findByID($registroLeitor['id_pessoa']));
                $leitores []= $leitor;
            }
            return $leitores;
        }

        public function deletarLeitor(){
            $leitor = new Leitor();
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitor->setId($leitorDAO->findById($_POST['id']));
            $leitorDAO->delete($leitor);
        }
    }
