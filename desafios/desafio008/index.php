<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de raízes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        $valor = $_GET["valor"]??0;
    ?>
    <main>
        <form action="<?=$_SERVER['PHP_SELF']?>" method = "get">
            <label for="Número">Número</label>
            <input type="number" name="valor" id="idvalor">
            <input type="submit" name="Calcular" id="idCalcular">
        </form>
    </main>

    <section>
        <h2>Resultados;</h2>
        <?php 
            $raizQ = $valor ** (1/2);
            $raizC = $valor ** (1/3);
            echo "Analisando o número <strong>$valor</strong>, temos:";
            echo "<ul><li>A sua raiz quadrada é <strong>$raizQ</strong></li><li>A sua raiz cúbica é <strong>$raizC</strong></li></ul>";
        ?>
    </section>
</body>
</html>