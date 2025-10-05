<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Livros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        require_once __DIR__ . '/../bootstrap.php';
    ?>
    <header><h1>Livros</h1></header>
    <main>
        <a href="../public/index.php?action=telacadastrarlivro">Novo Livro</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ISBN</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Páginas</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    if(!empty($livros)){
                        foreach($livros as $livro){
                            echo "<tr>";
                                echo "<td>" . htmlspecialchars($livro->getId()) . "</td>";
                                echo "<td>" . htmlspecialchars($livro->getISBN()) . "</td>";
                                echo "<td>" . htmlspecialchars($livro->getTitulo()) . "</td>";
                                echo "<td>" . htmlspecialchars($livro->getAutor()) . "</td>";
                                echo "<td >" . htmlspecialchars($livro->getEditora()) . "</td>";
                                echo "<td>" . htmlspecialchars($livro->getNumPaginas()) . "</td>";
                                echo "<td>";
                                    echo "<a href = '../public/index.php?action=editarlivro&id=". htmlspecialchars($livro->getId()) ." '>Editar</a>";
                                    echo "<a href = '../public/index.php?action=excluirlivro&id=". htmlspecialchars($livro->getId()) ."' onclick=\"return confirm('Tem certeza que deseja excluir este livro?');\" '>Excluir</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    } else
                        echo "<tr><td colspan='5'>Nenhum livro cadastrado</td></tr>";
                ?>
            </tbody>
        </table>
    </main>
    <section>
        <a href="index.php?action=telaprincipal">Voltar para a página principal</a>
    </section>
</body>
</html>