<?php
require_once './config/config.php';
require_once SERVER_ROOT . '/app/inc/session.inc.php';
require_once SERVER_ROOT . '/app/inc/artigos.inc.php';
require_once SERVER_ROOT . '/app/inc/contas.inc.php';
require_once SERVER_ROOT . '/app/inc/venda.inc.php';
require_once SERVER_ROOT . '/html/components/head.inc.php';

$pageTitle = 'Vendas';

// HTML
echo getHeader($pageTitle);
include(SERVER_ROOT . '/html/components/body_start.inc.php');
?>

<h1><?php echo $pageTitle; ?></h1>
<div class="row">
    <div class="col-12 col-lg-5">
        <form method="post" action="">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="barras">Código de Barras</label>
                        <input
                            type="text"
                            class="form-control"
                            id="barras"
                            name="barras"
                            inputmode="numeric"
                            maxlength="13"
                            minlength="13"
                            pattern="\d{13,13}"
                            required
                        >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input
                            type="number"
                            class="form-control"
                            id="quantidade"
                            name="quantidade"
                            required
                        >
                    </div>
                </div>
            </div>
            <div class="row">
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
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="submit" name="submit" value="Adicionar">
                </div>
            </div>
            <?php if (!empty($errorMsg)) { ?>
                <div class="row">
                    <div class="col">
                        <div class="alert alert-danger">
                            <?php echo $errorMsg ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </form>
    </div>
    <div class="col-12 col-lg-7">
        <?php if (!empty($_POST['submit'])) {
            $conta = lerConta($_POST['contribuente']);
            if (count($conta) > 0) { ?>
                <div>
                    <div>
                        <?php echo $conta['nomeCliente']; ?>
                    </div>
                    <?php if (!empty($conta['morada'])) { ?>
                        <div>
                            <?php echo $conta['morada']; ?>
                        </div>
                    <?php }
                    if (!empty($conta['cp']) || !empty($conta['localidade'])) { ?>
                        <div>
                            <?php echo $conta['codigoPostal'] . ' - ' . $conta['localidade']; ?>
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
                <?php foreach (lerVendas() as $codigo=>$venda) { ?>
                <tr>
                    <th scope="row"><?php echo $codigo; ?></th>
                    <td><?php echo $venda["nome"]; ?></td>
                    <td><?php echo $venda["quantidade"]; ?></td>
                    <td><?php echo $venda["iva"]; ?></td>
                    <td><?php echo $venda["precoUni"]; ?></td>
                    <td><?php echo $venda["quantidade"]*(1+$venda["iva"]/100)*$venda["precoUni"]; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include(SERVER_ROOT . '/html/components/body_end.inc.php'); ?>