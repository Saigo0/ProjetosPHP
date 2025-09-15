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
                'id_leitor' => $emprestimo->getIdLeitor(),
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
            $emprestimos = $stmt->execute([PDO::FETCH_ASSOC]);

            return $emprestimos;
        }

        public function findByID(int $id){
            $sql = "SELECT * FROM emprestimo WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id' => $id]);
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