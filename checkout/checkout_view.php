<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="center">
        <h1>Boleto pertencente à <?php echo $instituicao['entidade']?></h1> <br>
        <h2>Valor :<?php echo $guia['valor']?> </h2>
        <h2>Nosso numero:<?php echo $guia['nossonumero']?> </h2>
        <h2>Vencimento:<?php echo $guia['vencimento']?> </h2>
    </div>
</body>
</html>