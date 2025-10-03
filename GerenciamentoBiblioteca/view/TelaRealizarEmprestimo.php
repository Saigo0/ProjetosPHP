<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Empréstimos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Realizar Empréstimo</h1>
        <form action="">
            <label for="leitor">Selecione o leitor:</label>
            <select name="leitor" id="leitor" required>
                <?php foreach($leitores as $leitor): ?>
                    <option value="<?= $leitor->getId() ?>"><?= htmlspecialchars            ($leitor->getNome()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <fieldset>
                <legend>Selecione o(s) livro(s)</legend>
                <?php if(!empty($livros)):?>
                    <?php foreach($livros as $livro):?>
                        <div>
                            <input type="checkbox" name="livros[]" id="livro<?= $livro->getId() ?>" value="<?= $livro->getId() ?>">
                            <label for="livro<?= $livro->getId() ?>"><?= htmlspecialchars($livro->getTitulo()) ?> (ID: <?= $livro->getId() ?>)</label>
                        </div>
                        <?php endforeach;?>
                <?php else: ?>
                    <p>Nenhum livro disponível para empréstimo.</p>
                <?php endif; ?>
            </fieldset>
            
            <br><br>

            <input type="submit" value="Realizar Empréstimo">
        </form>
    </main>
    <section>
        <a href="../public/index.php?action=telaprincipal">Voltar</a>
    </section>
    
</body>
</html>