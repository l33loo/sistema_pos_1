<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/venda.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema PoS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/html/components/nav.inc.php') ?>
    <div class="container">
        <h1>Vendas</h1>
        <div class="row">
            <div class="col-12 col-lg-5">
                <form method="post" action="">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="barras">Código de Barras</label>
                                <input type="number" class="form-control" id="ean13" name="barras" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="quantidade">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Adicionar">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-7">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Cod Artigo</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Iva</th>
                            <th scope="col">Preço Unit</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (lerVendas() as $codigo=>$venda) { ?>
                        <tr>
                            <th scope="row"><?php echo $codigo; ?></th>
                            <td><?php echo $venda["nome"]; ?></td>
                            <td><?php echo $venda["quantidade"]; ?></td>
                            <td><?php echo $venda["iva"]; ?></td>
                            <td><?php echo $venda["precoUni"]; ?></td>
                            <td><?php echo $venda["quantidade"]*$venda["iva"]*$venda["precoUni"]; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>