
<?php
require_once '../config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . ROOT . '/app/pos_lib.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/head.inc.php';

$artigos = lerArtigos();

// HTML
echo getHeader('Lista de artigos');
include($_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/nav.inc.php');
?>

    <div class = "container m">
        <div class="row">
            <h1>Lista de Artigos</h1>
        </div>
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