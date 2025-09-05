<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reajustador de preços</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        $preco = $_GET["preco"]??0;
        $percentual = $_GET["percentual"]??0;
    ?>
    <main>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method = "get">
            <label for="preco">Preço do produto (R$)</label>
            <input type="number" name="preco" id="idpreco">
            <label for="porcent">Qual será o percentual de reajuste?</label>
            <input type="range" min = "0" max = "100" step = "1" name="percentual" id="idpercentual">
            <input type="submit" name="Reajustar" id="idReajustar">
        </form>
    </main>
    <section>
        <h2>Resultado do reajuste</h2>
        <?php 
            $novoPreco = $preco  + $preco * $percentual / 100;
            echo "Novo valor após aumento em $percentual%: $novoPreco."
        ?>
    </section>
</body>
</html>