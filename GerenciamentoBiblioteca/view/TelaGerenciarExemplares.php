<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciando Exemplares</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        require_once __DIR__ . '/../bootstrap.php';
    ?>
    <header><h1>Exemplares</h1></header>
    <main>
        <a href="../public/index.php?action=telacadastrarexemplar">Novo Exemplar</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>ID do livro</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    if(!empty($exemplares)){
                        foreach($exemplares as $exemplar){
                            echo "<tr>";
                                echo "<td>" . htmlspecialchars($exemplar->getId()) . "</td>";
                                echo "<td>" . htmlspecialchars($exemplar->getCodigoExemplar()) . "</td>";
                                echo "<td>" . htmlspecialchars($exemplar->getLivroId()) . "</td>";
                                echo "<td>" . htmlspecialchars($exemplar->getStatus()) . "</td>";
                                echo "<td>";
                                    echo "<a href = '../public/index.php?action=editarexemplar&id=". htmlspecialchars($exemplar->getId()) ." '>Editar</a>";
                                    echo "<a href = '../public/index.php?action=excluirexemplar&id=". htmlspecialchars($exemplar->getId()) ."' onclick=\"return confirm('Tem certeza que deseja excluir este exemplar?');\" '>Excluir</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    } else
                        echo "<tr><td colspan='5'>Nenhum exemplar cadastrado</td></tr>";
                ?>
            </tbody>
        </table>
    </main>
    <section>
        <a href="index.php?action=telaprincipal">Voltar para a página principal</a>
    </section>
</body>
</html>