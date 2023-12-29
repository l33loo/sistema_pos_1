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

<h1 class="py-3"><?php echo $pageTitle; ?></h1>
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
                    <div class="row py-2">
                        <div class="col">
                            <label for="nome" class="form-label">
                                Nome do artigo:
                            </label>
                            <input class="form-control" type="text" name="nome" id="nome" required>
                            <?php if (isset($erros['nomeArtigo'])) { ?>
                                <div class="alert alert-danger py-1 my-1"><?php echo $erros['nomeArtigo']; ?></div>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <label for="preco" class="form-label">
                                Preço Unitário:
                            </label>
                            <input  class="form-control" type="text" name="preco" id="preco">
                            <?php if (isset($erros['preco'])) { ?>
                                <div class="alert alert-danger py-1 my-1"><?php echo $erros['preco']; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col">
                            <label class="form-label" for="iva">
                                Escolha a taxa de IVA:
                            </label>
                            <select class="form-control" name="iva" id="iva" required>
                                <option value="0">0</option>
                                <option value="4">4</option>
                                <option value="9">9</option>
                                <option value="16">16</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="barras" class="form-label">
                                Código de barras:
                            </label>
                            <input
                                class="form-control"
                                type="text"
                                name="barras"
                                inputmode="numeric"
                                pattern="\d{12}"
                                title="O código de barras deve ter 12 dígitos"
                                required
                            >
                            <?php if (isset($erros['barras'])) { ?>
                                <div class="alert alert-danger py-1 my-1"><?php echo $erros['barras']; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                     <div class="row py-2">
                        <div class="col">
                            <button type="submit" class="btn btn-primary" name="submit">
                                Registar Artigo
                            </button>
                        </div>
                     </div>

                    <enctype="multipart/form-data"></enctype>
                    <?php if (!empty($msgSucesso)) { ?>
                        <div class="row py-3">
                            <div class="col">
                                <p class="alert alert-success"><?php echo $msgSucesso; ?></p>
                            </div>
                        </div>
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