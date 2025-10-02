<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Bibliotecário</title>
</head>
<body>
    <form action="../public/index.php?action=atualizarbibliotecario&id=<?= $bibliotecario->getId() ?>" method="post">
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($bibliotecario->getNome()) ?>">

    <label for="RG">RG</label>
    <input type="text" name="RG" id="RG" value="<?= htmlspecialchars($bibliotecario->getRG()) ?>">
    
    <label for="CPF">CPF</label>
    <input type="text" name="CPF" id="CPF" value="<?= htmlspecialchars($bibliotecario->getCPF()) ?>">

    <label for="dataNascimento">Data de Nascimento</label>
    <input type="date" name="dataNascimento" id="dataNascimento" value="<?= $bibliotecario->getDataNascimento()->format('Y-m-d') ?>">

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($bibliotecario->getEmail()) ?>">

    <label for="endereco">Endereço</label>
    <input type="text" name="endereco" id="endereco" value="<?= htmlspecialchars($bibliotecario->getEndereco()) ?>">
    
    <label for="telefone">Telefone</label>
    <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($bibliotecario->getTelefone()) ?>">
    
    <input type="submit" value="Atualizar">
</form>

</body>
</html>