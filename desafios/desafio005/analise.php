<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de um valor real</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <?php 
            $valor = $_GET["valor"];


            $int_valor = (int)$valor;
            $frac_valor = $valor - $int_valor;

            echo "<p>Valor digitado: " . $valor."<br>Parte inteira: ".$int_valor."<br>Parte fracionária: ". $frac_valor;

        
        ?>
        <button onclick="javascript:window.history.go(-1)">Voltar</button>
    </main>
</body>
</html>