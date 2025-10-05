<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando livro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <form action="../public/index.php?action=atualizarlivro&id=<?=    $livro->getId() ?>" method="post">
            <input type="hidden" name="id" id="id" value="<?= $livro->getId() ?>">
        
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($livro->getTitulo()) ?>">

            <label for="autor">Autor</label>
            <input type="text" name="autor" id="autor" value="<?= htmlspecialchars($livro->getAutor()) ?>">
            
            <label for="editora">Editora</label>
            <input type="text" name="editora" id="editora" value="<?= htmlspecialchars($livro->getEditora()) ?>">

            <label for="anoEdicao">Ano de edição</label>
            <input type="number" name="anoEdicao" id="anoEdicao" value="<?= $livro->getAnoEdicao() ?>">

            <label for="numPaginas">Número de páginas</label>
            <input type="number" name="numPaginas" id="numPaginas" value="<?= htmlspecialchars($livro->getNumPaginas()) ?>">

            <label for="localEdicao">Local de edição</label>
            <input type="text" name="localEdicao" id="localEdicao" value="<?= htmlspecialchars($livro->getLocalEdicao()) ?>">
            
            <input type="submit" value="Atualizar">
        </form>
    </main>
    
    <section>
        <a href="../public/index.php?action=gerenciarlivros">Cancelar</a>
    </section>
</body>
</html>