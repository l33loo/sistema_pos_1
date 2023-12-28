<?php
require_once '../config/config.php';
require_once SERVER_ROOT . '/app/inc/artigos.inc.php';
require_once SERVER_ROOT . '/app/inc/session.inc.php';
require_once SERVER_ROOT . '/html/components/head.inc.php';

$pageTitle = 'Artigos';

// HTML
echo getHeader($pageTitle);
include(SERVER_ROOT . '/html/components/body_start.inc.php');
?>

<h1><?php echo $pageTitle; ?></h1>
<div class="accordion" id="accordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Adicionar Artigo
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
            <div class="accordion-body">
                <form action="" method="post">
                    Nome do artigo: <input class="form-control form-control-lg" type="text" name="nome" maxlength="12"><br>
                    Preço Unitário: <input  class="form-control form-control-lg" type="text" name="preco" required><br>
                    <label for="iva"> Escolha a taxa de IVA</label>
                    <select name="iva" id="iva">
                        <option value="0">0</option>
                        <option value="4">4</option>
                        <option value="9">9</option>
                        <option value="16">16</option>
                    </select> </br> </br>
                    Código de barras <input class="form-control form-control-lg" type="text" name="barras" maxlength="13" minlength="13" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="submit">Registar Artigo</button>
                    <enctype="multipart/form-data"></enctype>
                    <?php if (!empty($msgSucesso)) { ?>
                        <p class="alert alert-success my-3"><?php echo $msgSucesso; ?></p>
                    <?php } ?>
                </form>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Lista de Artigos
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                <div class="accordion-body">
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
            </div>
        </div>
    </div>
</div>

<?php include(SERVER_ROOT . '/html/components/body_end.inc.php'); ?>