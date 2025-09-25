<?php 
    class ItemEmprestimoDAO{
        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function findById(int $id)
        {   
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $sql = "SELECT * FROM itememmprestimo WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $registroItemEmprestimo = $stmt->fetch(PDO::FETCH_ASSOC);

            $itemEmprestimo = new ItemEmprestimo();

            $itemEmprestimo->setId($registroItemEmprestimo['id']);
            $itemEmprestimo->setExemplar($exemplarDAO->findByID($registroItemEmprestimo['id_exemplar']));
            $itemEmprestimo->setIdEmprestimo($registroItemEmprestimo['id_emprestimo']);

            return $itemEmprestimo;
        }
        
    }