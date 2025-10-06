<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Empréstimos</h1>
    </header>
    

    <?php 
        require_once __DIR__ . '/../bootstrap.php';
    ?>
    <main>
        <?php if (isset($_GET['erro'])): ?>
            <div class="erro" style="color: red;">
                <?= htmlspecialchars($_GET['erro']) ?>
            </div>
            <script>
                if (window.history.replaceState) {
                    const url = new URL(window.location);
                    url.searchParams.delete('erro');
                    window.history.replaceState({}, document.title, url);
                }
            </script>
        <?php endif; ?>
        <a href="../public/index.php?action=telarealizaremprestimo">Novo Empréstimo</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Leitor</th>
                    <th>Data do empréstimo</th>
                    <th>Data de devolução</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    if(!empty($emprestimos)){
                        foreach($emprestimos as $emprestimo){
                            echo "<tr>";
                                echo "<td>" . htmlspecialchars($emprestimo->getId()) . "</td>";
                                echo "<td>" . htmlspecialchars($emprestimo->getLeitor()->getNome()) . "</td>";
                                echo "<td>" . htmlspecialchars($emprestimo->getDataEmprestimo()->format('Y-m-d')) . "</td>";
                                echo "<td>" . htmlspecialchars($emprestimo->getDataDevolucao()->format('Y-m-d')) . "</td>";
                                echo "<td>" . htmlspecialchars($emprestimo->getStatus()) . "</td>";
                                echo "<td>";
                                    echo "<a href = '../public/index.php?action=devolveremprestimo&id=". htmlspecialchars($emprestimo->getId()) ." '>Devolver</a>";
                                    echo "<a href = '../public/index.php?action=excluiremprestimo&id=". htmlspecialchars($emprestimo->getId()) ."' onclick=\"return confirm('Tem certeza que deseja excluir este empréstimo?');\" '>Excluir</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    } else
                        echo "<tr><td colspan='5'>Nenhum empréstimo realizado</td></tr>";
                ?>
            </tbody>
        </table>
    </main>
    <section>
        <div><a href="index.php?action=telaprincipal">Voltar para a página principal</a></div>
    </section>
</body>
</html>