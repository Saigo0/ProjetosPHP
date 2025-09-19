<?php 
    class EmprestimoDAO{
        private PDO $pdo;
        

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Emprestimo $emprestimo){
            $sql = "INSERT INTO emprestimo (id_item_emprestimo, id_leitor, dataEmprestimo, dataDevolucao, status, descricao) VALUES (:id_item_emrpestimo, :id_leitor, :dataEmprestimo, :dataDevolucao, :status, :descricao)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_item_emprestimo' => $emprestimo->getIdItemEmprestimo(),
                'id_leitor' => $emprestimo->getLeitor()->getId(),
                'dataEmprestimo' => $emprestimo->getDataEmprestimo(),
                'dataDevolucao' => $emprestimo->getDataDevolucao(),
                'status' => $emprestimo->getStatus(),
                'descricao' => $emprestimo->getDescricao()
            ]);
        }

        public function update($emprestimo){
            $sql = "UPDATE emprestimo SET
                id_item_emprestimo = :id_item_emprestimo,
                id_leitor = :id_leitor,
                dataEmprestimo = :dataEmprestimo,
                dataDevolucao = :dataDevolucao,
                status = :status,
                descricao = :descricao WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_item_emprestimo' => $emprestimo->getIdItemEmprestimo(),
                'id_leitor' => $emprestimo->getIdLeitor(),
                'dataEmprestimo' => $emprestimo->getDataEmprestimo(),
                'dataDevolucao' => $emprestimo->getDataDevolucao(),
                'status' => $emprestimo->getStatus(),
                'descricao' => $emprestimo->getDescricao()
            ]);
        }

        public function listAll(){
            $sql = "SELECT * FROM emprestimo";
            $stmt = $this->pdo->query($sql);
            $stmt->execute([PDO::FETCH_ASSOC]);
            $emprestimos = $stmt->fetchAll();
            return $emprestimos;
        }

        public function findByID(int $id){
            $sql = "SELECT * FROM emprestimo WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id' => $id]);
        }

        public function findByDate(DateTime $data){
            $sql = "SELECT * FROM emprestimo WHERE dataEmprestimo = :data";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['data' => $data->format('Y-m-d')]);
            $arrayAsso = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $emprestimos = [];
            foreach($arrayAsso as $registroEmprestimo){
                $emprestimo = new Emprestimo();
                $leitorDAO = new LeitorDAO(Conexao::getPDO());
                $emprestimo->setId($registroEmprestimo['id']);
                $emprestimo->setLeitor($leitorDAO->findByID($registroEmprestimo['id_leitor']));
                $emprestimo->setDataEmprestimo(new DateTime($registroEmprestimo['dataEmprestimo']));
                $emprestimo->setDataDevolucao(new DateTime($registroEmprestimo['dataDevolucao']));
                $emprestimo->setStatus($registroEmprestimo['status']);
                $emprestimo->setDescricao($registroEmprestimo['descricao']);
                $emprestimos += $emprestimo;
            }
            return $emprestimos;
        }

        public function delete(Emprestimo $emprestimo){
            $sql = "DELETE FROM emprestimo WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $emprestimo->getId()
            ]);
        }

    }
?>