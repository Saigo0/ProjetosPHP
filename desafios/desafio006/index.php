<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anatomia de uma divisão inteira</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        $dividendo = $_GET["dividendo"]??0;
        $divisor = $_GET["divisor"]??0;
    ?>
    <main>
        <h1>Anatomia de uma divisão inteira</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
            <label for="div">Dividendo</label>
            <input type="number" name="dividendo" id="iddividendo" step = "any">
            <label for="divis">Divisor</label>
            <input type="number" name="divisor" id="iddivisor" step = "any">
            <input type="submit" name="Analisar">
        </form>
    </main>
    
    <section>
        <h2>Estrutura da dvisão inteira</h2>
        <?php 
        if($divisor != 0){
            $quociente = intdiv($dividendo, $divisor);
            $resto = $dividendo%$divisor;
            echo "<p>$dividendo dividido por $divisor é igual a $quociente e possui resto igual a $resto</p>";
        } else {
            echo "<p>Divisor inválido ou não informado.</p>";
        }

        
        ?>
    </section>

</body>
</html>