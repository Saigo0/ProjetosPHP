<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leitores</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        require_once __DIR__ . '/../bootstrap.php';
    ?>
    <header><h1>Leitores</h1></header>
    <main>
        <a href="../public/index.php?action=telacadastrarleitor">Novo Leitor</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Pendente</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    if(!empty($leitores)){
                        foreach($leitores as $leitor){
                            echo "<tr>";
                                echo "<td>" . htmlspecialchars($leitor->getId()) . "</td>";
                                echo "<td>" . htmlspecialchars($leitor->getNome()) . "</td>";
                                echo "<td>" . htmlspecialchars($leitor->getEmail()) . "</td>";
                                echo "<td>" . htmlspecialchars($leitor->getTelefone()) . "</td>";
                                echo "<td style='color:" . ($leitor->getMultasPendentes() ? "red" : "green") . ";'>" 
                                . ($leitor->getMultasPendentes() ? 'Sim' : 'Não') . "</td>";

                                echo "<td>";
                                    echo "<a href = '../public/index.php?action=editarleitor&id=". htmlspecialchars($leitor->getId()) ." '>Editar</a>";
                                    echo "<a href = '../public/index.php?action=excluirleitor&id=". htmlspecialchars($leitor->getId()) ."' onclick=\"return confirm('Tem certeza que deseja excluir este leitor?');\" '>Excluir</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    } else
                        echo "<tr><td colspan='5'>Nenhum leitor cadastrado</td></tr>";
                ?>
            </tbody>
        </table>
    </main>
    <section>
        <a href="index.php?action=telaprincipal">Voltar para a página principal</a>
    </section>
    
    
</body>
</html>