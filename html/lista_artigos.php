
<?php
require_once '../config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . ROOT . '/app/lib/pos.lib.php';
require_once $_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/head.inc.php';

$artigos = lerArtigos();
$pageTitle = 'Lista de artigos';

// HTML
echo getHeader($pageTitle);
include($_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/nav.inc.php');
?>

<h1><?php echo $pageTitle; ?></h1>
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

<?php include($_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/end.inc.php'); ?>