<?php 
    require_once __DIR__ . '/../bootstrap.php';
    class ExemplarController{
        public function criarExemplar(){
            $exemplar = new Exemplar();
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());

            $exemplar->setCodigoExemplar($_POST['codExemplar']);
            $exemplar->setLivroId($_POST['id_livro']);

            $exemplarDAO->create($exemplar);

            header("Location: ../view/TelaCadastrarExemplar.php");
            exit;
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
            $arrayAsso = $exemplarDAO->listAll();
            $exemplares = [];
            foreach($arrayAsso as $registroExemplar){
                $exemplar = new Exemplar();
                $exemplar->setID($_POST['id']);
                $exemplar->setCodigoExemplar($_POST['codigoExemplar']);
                $exemplar->setStatus($_POST['status']);
                $exemplar->setLivroId($_POST['id_livro']);
                $exemplares[] = $exemplar;
            }
            return $exemplares;
        }

        public function deletarExemplar(){
            $exemplar = new Exemplar();
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $exemplar->setId($exemplarDAO->findById($_POST['id'])->getId());
            $exemplarDAO->delete($exemplar);
        }
    }