<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de números aleatórios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Gerador de números aleatórios</h1>
    </header>
    <main>
        <?php 
            $min = 0;
            $max = 100;
            $num = mt_rand($min, $max);
            echo "<p>Gerando um número aleatório entre $min e $max... <br>O valor gerado foi <strong>$num</strong>";
        ?>
        <button onclick = "javascript:document.location.reload()">Gerar novamente</button>
    </main>
</body>
</html>