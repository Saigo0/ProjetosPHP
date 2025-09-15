<?php 
    class LeitorController{
        public function criarLeitor(){
            $leitor = new Leitor();
            $leitor->setNome($POST['nome']);
            $leitor->setRG($POST['RG']);
            $leitor->setCPF($POST['CPF']);
            $leitor->setDataNascimento($POST['dataNascimento']);
            $leitor->setEmail($POST['email']);
            $leitor->setEndereco($POST['endereco']);
            $leitor->setTelefone($POST['telefone']);

            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitorDAO->create($leitor);
        }

        public function atualizarLeitor(){
            $leitor = new Leitor();

            $leitor->setNome($POST['nome']);
            $leitor->setRG($POST['RG']);
            $leitor->setCPF($POST['CPF']);
            $leitor->setDataNascimento($POST['dataNascimento']);
            $leitor->setEmail($POST['email']);
            $leitor->setEndereco($POST['endereco']);
            $leitor->setTelefone($POST['telefone']);

            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitorDAO->update($leitor);
        }

        public function listarLeitores(){
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitores = $leitorDAO->listAll();
            return $leitores;
        }

        public function deletarLeitores(){
            $leitor = new Leitor();
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitor->setId($leitorDAO->findById($POST['id']));
            $leitorDAO->delete($leitor);
        }
    }
