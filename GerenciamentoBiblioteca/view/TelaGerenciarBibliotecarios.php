<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotecários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bibliotecários</h1>
    

    <?php 
        require_once __DIR__ . '/../bootstrap.php';
    ?>
    <main>
        <a href="../public/index.php?action=telacadastrarbibliotecario">Novo Bibliotecário</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>RegistroCRB</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    if(!empty($bibliotecarios)){
                        foreach($bibliotecarios as $bibliotecario){
                            echo "<tr>";
                                
                                echo "<td>" . htmlspecialchars($bibliotecario->getId()) . "</td>";
                                echo "<td>" . htmlspecialchars($bibliotecario->getNome()) . "</td>";
                                echo "<td>" . htmlspecialchars($bibliotecario->getEmail()) . "</td>";
                                echo "<td>" . htmlspecialchars($bibliotecario->getTelefone()) . "</td>";
                                echo "<td>" . htmlspecialchars($bibliotecario->getRegistroCRB()) . "</td>";
                                echo "<td>";
                                    echo "<a href = '../public/index.php?action=editarBibliotecario&id=". htmlspecialchars($bibliotecario->getId()) ." '>Editar</a>";
                                    echo "<a href = '../public/index.php?action=excluirBibliotecario&id=". htmlspecialchars($bibliotecario->getId()) ."' onclick=\"return confirm('Tem certeza que deseja excluir este bibliotecário?');\" '>Excluir</a>";
                                echo "</td>";

                            echo "</tr>";
                        }
                    } else
                        echo "<tr><td colspan='5'>Nenhum bibliotecário cadastrado</td></tr>";
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>