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
            $valor = $_GET["button"];
            if($valor == ""){
                $valor = rand(1, 100);
            }
            echo "<p> Valor gerado: $valor";
        ?>

        <p><a href="javascript:history.go(-1)">Gerar novamente</a></p>
    </main>
</body>
</html>