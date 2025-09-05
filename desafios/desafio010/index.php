<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method = "get">
            <label for="anoNasc">Ano de nascimento</label>
            <input type="number" name="anoNasc" id="idanoNasc">
            <label for="novaIdade">Quer saber a sua idade em qual ano?</label>
            <input type="number" name="anoNovaIdade" id="idanoNovaIdade">
            <input type="submit" name="Enviar" id="idEnviar">
        </form>
    </main>
    <?php 
        $anoNasc = $_GET["anoNasc"]??0;
        $anoNovaIdade = $_GET["anoNovaIdade"]??0;
    ?>
    <section>
        <h2>Resultado</h2>
        <?php 
            if($anoNovaIdade < $anoNasc){
                echo "Você ainda não teria nascido em $anoNovaIdade";
            } else
                echo "Você tem <strong>".$anoNovaIdade - $anoNasc."</strong> anos de idade em $anoNovaIdade.";
        ?>
    </section>
</body>
</html>