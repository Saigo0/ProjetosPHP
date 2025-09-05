<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salário mínimo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        $salario = $_GET["salario"]??0;
    ?>
    <main>
        <h1>Informe seu salário</h1>
        <form action="<?= $_SERVER['PHP_SELF']?>" method = "get">
            <label for="salario">Salário(R$)</label>
            <input type="number" name="salario" id="idsalario">
            <input type="submit" name="Calcular" id="idCalcular">
        </form>
    </main>

    <section>
        <h2>Resultado final</h2>
        <?php 
            $salMin = 1518.00;
            $numSalMin = $salario/$salMin;
            if($salario >= $salMin){
                $resto = $salario%$salMin;
                echo "Quem recebe um salário de R$$salario ganha ".number_format($numSalMin, 2, ",", ".")." salários mínimos + R$$resto";
            } else
                echo "Quem recebe um salário de R$$salario ganha ". number_format($numSalMin * 100, 2, ",", ".") ."% de um salário mínimo";
        ?>
    </section>
</body>
</html>