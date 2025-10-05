<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Exemplar</title>
</head>
<body>
    <main>
        <form action="../public/index.php?action=atualizarexemplar&id=<?=    $exemplar->getId() ?>" method="post">
            <input type="hidden" name="id" id="id" value="<?= $exemplar->getId() ?>">
        
            <label for="codExemplar">Código</label>
            <input type="text" name="codExemplar" id="codExemplar" value="<?= htmlspecialchars($exemplar->getCodigoExemplar()) ?>">
            
            <input type="submit" value="Atualizar">
        </form>
    </main>
    
    <section>
        <a href="../public/index.php?action=gerenciarexemplares">Cancelar</a>
    </section>
</body>
</html>