<?php
require_once './config/config.php';
require_once SERVER_ROOT . '/app/inc/session.inc.php';
require_once SERVER_ROOT . '/app/inc/venda.inc.php';
require_once SERVER_ROOT . '/html/components/head.inc.php';

$pageTitle = 'Vendas';

// HTML
echo getHeader($pageTitle);
require_once SERVER_ROOT . '/html/components/body_start.inc.php';
?>

<h1 class="py-3"><?php echo $pageTitle; ?></h1>
<div class="row">
    <div class="col-12 col-lg-5">
        <form method="post" action="">
            <div class="row py-1">
                <div class="col">
                    <div class="form-group">
                        <label class="w-100 fw-bold text-center" for="barras">Código de Barras</label>
                        <input
                            type="text"
                            class="form-control"
                            id="barras"
                            name="barras"
                            inputmode="numeric"
                            pattern="\d{13}"
                            title="O código de barras deve ter 13 dígitos"
                            required
                        >
                        <?php if (!empty($erros['barras'])) { ?>
                            <div class="alert alert-danger py-1 my-1"><?php echo $erros['barras']; ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="fw-bold text-center w-100" for="quantidade">Quantidade</label>
                        <input
                            type="number"
                            class="form-control"
                            id="quantidade"
                            name="quantidade"
                            required
                        >
                        <?php if (!empty($erros['quantidade'])) { ?>
                            <div class="alert alert-danger py-1 my-1"><?php echo $erros['quantidade']; ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row py-1">
                <div class="col">
                    <div class="form-group">
                        <label for="contribuente">Cod Cliente</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input
                            id="contribuente"
                            name="contribuente"
                            type="text"
                            inputmode="numeric"
                            class="form-control"
                            pattern="\d{9}"
                            title="O número de contribuente deve ter 9 dígitos"
                            <?php if (!empty($_POST['contribuente'])) { ?>
                                value="<?php echo $_POST['contribuente']; ?>"
                            <?php } ?>
                        >
                        <?php if (!empty($erros['contribuente'])) { ?>
                            <div class="alert alert-danger py-1 my-1"><?php echo $erros['contribuente']; ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="submit" name="submit" value="Adicionar">
                </div>
            </div>
            <?php if (!empty($successMsg) && count($erros) === 0) { ?>
                <div class="row py-3">
                    <div class="col">
                        <div class="alert alert-success"><?php echo $successMsg; ?></div>
                    </div>
                </div>
            <?php } elseif (!empty($erros['guardar'])) { ?>
                <div class="row py-3">
                    <div class="col">
                        <div class="alert alert-danger"><?php echo $erros['guardar']; ?></div>
                    </div>
                </div>
            <?php } ?>
        </form>
    </div>
    <div class="col-12 col-lg-7">
        <?php if (!empty($_POST['submit'])) {
            if (count($conta) > 0) { ?>
                <div class="border-bottom border-secondary pb-2">
                    <div class="fw-bold">
                        <?php echo $conta['nome']; ?>
                    </div>
                    <?php if (!empty($conta['morada'])) { ?>
                        <div>
                            <?php echo $conta['morada']; ?>
                        </div>
                    <?php }
                    if (!empty($conta['cp']) || !empty($conta['localidade'])) { ?>
                        <div>
                            <?php echo $conta['cp'] . ' - ' . $conta['localidade']; ?>
                        </div>
                    <?php } ?>
                    <div>
                        <?php echo 'Contribuente: ' . $conta['contribuente']; ?>
                    </div>
                </div>
            <?php }
        } ?>
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
                <?php $total = 0;
                if (!empty($_POST['submit'])) {
                    foreach (vendasDaConta($_POST['contribuente']) as $venda) {
                        $totalArtigo = $venda["quantidade"]*(1+$venda["iva"]/100)*$venda["precoUni"];
                        $total += $totalArtigo; ?>
                        <tr>
                            <th scope="row"><?php echo $venda['codigo']; ?></th>
                            <td><?php echo $venda["nome"]; ?></td>
                            <td><?php echo $venda["quantidade"]; ?></td>
                            <td><?php echo $venda["iva"] . '%'; ?></td>
                            <td><?php echo $venda["precoUni"] . ' €'; ?></td>
                            <td><?php echo number_format($totalArtigo, 2, ',', ' ') . ' €'; ?></td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
        <?php if ($total > 0) { ?>
            <div>
                <span class="fw-bold">Total:</span> <?php echo number_format($total, 2, ',', ' ') . ' €'; ?>
            </div>
            <div>
                <span class="fw-bold">Total C/ Desconto:</span> <?php echo number_format($total*(1-$conta['desconto']), 2, ',', ' ') . ' €'; ?>
            </div>
        <?php } ?>
    </div>
</div>

<?php require_once SERVER_ROOT . '/html/components/body_end.inc.php'; ?>