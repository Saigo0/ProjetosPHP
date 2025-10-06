<?php 
    require_once __DIR__ . '/../bootstrap.php';
    class ExemplarController{
        public function criarExemplar(){
            $exemplar = new Exemplar();
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());

            $exemplar->setCodigoExemplar($_POST['codExemplar']);
            $exemplar->setLivroId($_POST['id_livro']);
            $exemplar->setStatus('DISPONIVEL');

            $exemplarDAO->create($exemplar);

            header("Location: ../public/index.php?action=gerenciarexemplares");
            exit;
        }

        public function telaCadastrarExemplar(){
            require __DIR__ . '/../view/TelaCadastrarExemplar.php';
        }
        
        public function atualizarExemplar(){
            $exemplar = new Exemplar();
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $exemplar->setId($_POST['id']);
            $exemplar->setLivroId($exemplarDAO->findById($exemplar->getId())->getLivroId());
            $exemplar->setCodigoExemplar($_POST['codExemplar']);
            $exemplar->setStatus($_POST['status']);
            $exemplarDAO->update($exemplar);
            header("Location: ../public/index.php?action=gerenciarexemplares");
            exit;
        }

        public function listarExemplares(){
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $exemplares = $exemplarDAO->listAll();
            
            require __DIR__ . '/../view/TelaGerenciarExemplares.php';
        }

        public function deletarExemplar(){
            $exemplar = new Exemplar();
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $exemplar->setId($_GET['id']);
            $exemplarDAO->delete($exemplar);

            header("Location: ../public/index.php?action=gerenciarexemplares");
            exit;
        }
    }