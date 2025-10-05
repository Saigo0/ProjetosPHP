<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando leitor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <form action="../public/index.php?action=atualizarleitor&id=<?=    $leitor->getId() ?>" method="post">
            <input type="hidden" name="id" id="id" value="<?= $leitor->getId() ?>">
        
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($leitor->getNome()) ?>">

            <label for="RG">RG</label>
            <input type="text" name="RG" id="RG" value="<?= htmlspecialchars($leitor->getRG()) ?>">
            
            <label for="CPF">CPF</label>
            <input type="text" name="CPF" id="CPF" value="<?= htmlspecialchars($leitor->getCPF()) ?>">

            <label for="dataNascimento">Data de Nascimento</label>
            <input type="date" name="dataNascimento" id="dataNascimento" value="<?= $leitor->getDataNascimento()->format('Y-m-d') ?>">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($leitor->getEmail()) ?>">

            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco" value="<?= htmlspecialchars($leitor->getEndereco()) ?>">
            
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($leitor->getTelefone()) ?>">
            
            <input type="submit" value="Atualizar">
        </form>
    </main>
    
    <section>
        <a href="../public/index.php?action=gerenciarleitores">Cancelar</a>
    </section>

</body>
</html>