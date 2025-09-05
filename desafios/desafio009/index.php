<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de médias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <main>
        <h1>Insira os valores:</h1>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method = "get">
            <label for="val1">Valor 1</label>
            <input type="number" name="valor1" id="idvalor1">
            <label for="peso1">Peso 1</label>
            <input type="number" name="peso1" id="idpeso1">
            <label for="val2">Valor 2</label>
            <input type="number" name="valor2" id="idvalor2">
            <label for="peso2">Peso 2</label>
            <input type="number" name="peso2" id="idpeso2">
            <input type="submit" name="Calcular médias" id="idCalcular">
        </form>
    </main>
    <?php
        $valor1 = $_GET["valor1"]?? 1;
        $valor2 = $_GET["valor2"]?? 1;
        $peso1 = $_GET["peso1"]?? 1;
        $peso2 = $_GET["peso2"]?? 1;
    ?>

    <section>
        <h2>Cálculo das médias</h2>
        <?php 
            $mediaSimples = ($valor1 + $valor2)/2;
            $mediaPonderada = ($valor1*$peso1 + $valor2*$peso2)/$peso1 + $peso2;
            echo "Analisando os valores $valor1 e $valor2: <br>";
            echo "<ul>
                    <li>A média aritmética simples entre os valores é igual a $mediaSimples</li>
                    <li>A média aritmética ponderada entre os valores é igual a $mediaPonderada</li>
                  </ul>";
        ?>
    </section>
</body>
</html>