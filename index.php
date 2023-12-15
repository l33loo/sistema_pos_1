<?php
require_once './config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . ROOT . '/app/venda.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/head.inc.php';

// HTML
echo getHeader('Vendas');
include($_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/nav.inc.php');
?>

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

<?php include($_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/end.inc.php'); ?>