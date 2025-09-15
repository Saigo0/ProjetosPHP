<?php 
    class ExemplarController{
        public function criarExemplar(){
            $exemplar = new Exemplar();
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());

            $exemplar->setCodigoExemplar($_POST['codExemplar']);
            $exemplar->setStatus($_POST['statusExemplar']);

            $exemplarDAO->create($exemplar);
        }

        public function atualizarExemplar(){
            $exemplar = new Exemplar();
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $exemplar->setCodigoExemplar($_POST['codExemplar']);
            $exemplar->setStatus($_POST['statusExemplar']);

            $exemplarDAO->update($exemplar);
        }

        public function listarExemplares(){
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $exemplares = $exemplarDAO->listAll();
            return $exemplares;
        }

        public function deletarExemplar(){
            $exemplar = new Exemplar();
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $exemplar->setId($exemplarDAO->findById($_POST['id']));
            $exemplarDAO->delete($exemplar);
        }
    }