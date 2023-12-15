<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Artigos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
    <div class = "container m"> 
        <div class="row">
            <h1>Lista de Artigos</h1>
        </div>

<?php
require_once '../config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . ROOT . '/app/pos_lib.inc.php';

$artigos = lerArtigos();?> 

        <table class="table">
            <thead>
                <tr>
                    <th>Codigo de Artigo</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>IVA (%)</th>
                    <th>Codigo de Barras</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artigos as $barras => $artigo) { ?>
                <tr>
                    <td><?php echo $artigo['codigo'];?>
                    <td><?php echo $artigo['nome'];?></td>
                    <td><?php echo $artigo['preco'] . ' €';?></td>
                    <td><?php echo $artigo['iva'];?></td>
                    <td><?php echo $barras;?></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</body>
</html>