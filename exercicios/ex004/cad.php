<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Resultado do processamento</h1>
    </header>
    <main>
        <?php 
            $valor = $_GET["valor"] ?? "Valor não alocado";
            $antecessor = $valor - 1;
            $sucessor = $valor + 1;

            echo  "<p>O valor inserido foi <strong>$valor</strong>";
            echo  "<p>O antecessor desse valor é <strong>$antecessor</strong>";
            echo  "<p>O sucessor desse valor é <strong>$sucessor</strong>";
        ?>
        <p><a href="javascript:history.go(-1)">Voltar para a página anterior</a></p>
    </main>
</body>
</html>