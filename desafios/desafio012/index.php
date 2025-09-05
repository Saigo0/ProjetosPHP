<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de tempo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        $segundos = $_GET["segundos"]??0;
    ?>
    <main>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method = "get">
            <label for="segundos">Qual é o total de segundos?</label>
            <input type="number" name="segundos" id="idsegundos">
            <input type="submit" name="Calcular" id="idCalcular">
        </form>
    </main>
    <section>
        <h2>Totalizando tudo</h2>
        <?php 
            $semanas = $segundos / 604800;
            $dias = ($segundos % 604800)/86400;
        
            echo "$semanas semanas, $dias dias e $horas horas."; 
        ?>
    </section>
</body>
</html>