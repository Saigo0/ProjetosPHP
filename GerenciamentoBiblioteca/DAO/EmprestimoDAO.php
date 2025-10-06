<?php 
    class EmprestimoDAO{
        private PDO $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function create(Emprestimo $emprestimo){
            $sqlEmprestimo = "INSERT INTO emprestimo (id_leitor, dataEmprestimo, dataDevolucao, status, descricao) VALUES (:id_leitor, :dataEmprestimo, :dataDevolucao, :status, :descricao)";
            $stmt = $this->pdo->prepare($sqlEmprestimo);
            $stmt->execute([
                'id_leitor' => $emprestimo->getLeitor()->getId(),
                'dataEmprestimo' => $emprestimo->getDataEmprestimo()->format('Y-m-d'),
                'dataDevolucao' => $emprestimo->getDataDevolucao()->format('Y-m-d'),
                'status' => $emprestimo->getStatus(),
                'descricao' => $emprestimo->getDescricao()
            ]);

            $idEmprestimo = $this->pdo->lastInsertId();
            
            $sqlItemEmprestimo = "INSERT INTO itememprestimo (id_exemplar, id_emprestimo) VALUES (:id_exemplar, :id_emprestimo)";
            $stmt = $this->pdo->prepare($sqlItemEmprestimo);
                foreach($emprestimo->getItensEmprestimo() as $itemEmprestimo){
                    $stmt->execute([
                        'id_exemplar' => $itemEmprestimo->getIdExemplar(),
                        'id_emprestimo' => $idEmprestimo
                    ]);
                }
                
        }

    

        public function update($emprestimo){
            $sql = "UPDATE emprestimo SET
                id_leitor = :id_leitor,
                dataEmprestimo = :dataEmprestimo,
                dataDevolucao = :dataDevolucao,
                status = :status,
                descricao = :descricao WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $emprestimo->getId(),
                'id_leitor' => $emprestimo->getLeitor()->getId(),
                'dataEmprestimo' => $emprestimo->getDataEmprestimo()->format('Y-m-d'),
                'dataDevolucao' => $emprestimo->getDataDevolucao()->format('Y-m-d'),
                'status' => $emprestimo->getStatus(),
                'descricao' => $emprestimo->getDescricao()
            ]);

            $sqlItemEmprestimo = "UPDATE itememprestimo SET
                id_exemplar = :id_exemplar,
                id_emprestimo = :id_emprestimo";
            
            $stmt = $this->pdo->prepare($sqlItemEmprestimo);
            foreach($emprestimo->getItensEmprestimo() as $itemEmprestimo){
                    $stmt->execute([
                        'id_exemplar' => $itemEmprestimo->getIdExemplar(),
                        'id_emprestimo' => $itemEmprestimo->getIdEmprestimo()
                    ]);
                }
        }

        public function listAll(){
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $sql = "SELECT * FROM emprestimo";

            $stmt = $this->pdo->query($sql);
            $arrayEmprestimos= $stmt->fetchAll(PDO::FETCH_ASSOC);

            $emprestimos = [];

            foreach($arrayEmprestimos as $registroEmprestimo){
                $emprestimo = new Emprestimo();
                $emprestimo->setId($registroEmprestimo['id']);
                $emprestimo->setLeitor($leitorDAO->findByID($registroEmprestimo['id_leitor']));
                $emprestimo->setDataDevolucao(new DateTime($registroEmprestimo['dataDevolucao']));
                $emprestimo->setDataEmprestimo(new DateTime($registroEmprestimo['dataEmprestimo']));
                $emprestimo->setStatus($registroEmprestimo['status']);
                $emprestimo->setDescricao($registroEmprestimo['descricao']);
                

                $sqlItens = "SELECT * FROM itememprestimo WHERE id_emprestimo = :id_emprestimo";

                $stmt = $this->pdo->prepare($sqlItens);
                $stmt->execute(['id_emprestimo' => $registroEmprestimo['id']]);
                $arrayItens = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $itensEmprestimo = [];

                foreach($arrayItens as $registroItem){
                    $item = new ItemEmprestimo();
                    $item->setId($registroItem['id']);
                    $item->setExemplar($exemplarDAO->findByID($registroItem['id_exemplar']));
                    $item->setIdEmprestimo($registroItem['id_emprestimo']);
                    $itensEmprestimo [] = $item;
                }
                $emprestimo->setItensEmprestimo($itensEmprestimo);
                $emprestimos [] = $emprestimo;
            }
            return $emprestimos;
        }

    
        public function findByID(int $id){
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $exemplarDAO = new ExemplarDAO(Conexao::getPDO());
            $sql = "SELECT * FROM emprestimo WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $registroEmprestimo = $stmt->fetch(PDO::FETCH_ASSOC);

            $emprestimo = new Emprestimo();

            $emprestimo->setId($registroEmprestimo['id']);
            $emprestimo->setLeitor($leitorDAO->findByID($registroEmprestimo['id_leitor']));
            $emprestimo->setDataEmprestimo(new DateTime($registroEmprestimo['dataEmprestimo']));
            $emprestimo->setDataDevolucao(new DateTime($registroEmprestimo['dataDevolucao']));
            $emprestimo->setStatus($registroEmprestimo['status']);
            $emprestimo->setDescricao($registroEmprestimo['descricao']);

            
            $sqlItens = "SELECT * FROM itememprestimo WHERE id_emprestimo = :id_emprestimo";
            $stmtItens = $this->pdo->prepare($sqlItens);
            $stmtItens->execute(['id_emprestimo' => $registroEmprestimo['id']]);
            $arrayItens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

            $itensEmprestimo = [];
            foreach($arrayItens as $registroItem){
                $item = new ItemEmprestimo();
                $item->setId($registroItem['id']);
                $item->setExemplar($exemplarDAO->findByID($registroItem['id_exemplar']));
                $item->setIdEmprestimo($registroItem['id_emprestimo']);
                $itensEmprestimo[] = $item;
            }
            
            $emprestimo->setItensEmprestimo($itensEmprestimo);

            return $emprestimo;
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
            $sqlItens = "DELETE FROM itememprestimo WHERE id_emprestimo = :id_emprestimo";
            $stmtItens = $this->pdo->prepare($sqlItens);
            $stmtItens->execute(['id_emprestimo' => $emprestimo->getId()]);

            $sqlEmprestimo = "DELETE FROM emprestimo WHERE id = :id";
            $stmtEmprestimo = $this->pdo->prepare($sqlEmprestimo);
            $stmtEmprestimo->execute(['id' => $emprestimo->getId()]);
        }

    }
?>