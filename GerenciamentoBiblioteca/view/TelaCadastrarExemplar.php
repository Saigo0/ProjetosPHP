<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar exemplar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Cadastrar novo exemplar</h1></header>
    <main>
        <form action="../public/index.php?action=cadastrarExemplar">
            <label for="codigoExemplar">Código do exemplar</label>
            <input type="text" name="codigoExemplar" id="codigoExemplar">
            <label for="id_livro">ID do livro</label>
            <input type="number" name="id_livro" id="id_livro">
            <input type="submit" name="Cadastrar" id="Cadastrar" value = "Cadastrar">
        </form>
    </main>
    <section>
        <a href="index.php?action=telaprincipal">Voltar para a página inicial</a>
    </section>
    <section>
        <a href="index.php?action=gerenciarleitores">Voltar</a>
    </section>
</body>
</html>