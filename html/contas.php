<?php
require_once '../config/config.php';
require_once SERVER_ROOT . '/app/inc/contas.inc.php';
require_once SERVER_ROOT . '/html/components/head.inc.php';

$pageTitle = 'Contas';

// HTML
echo getHeader($pageTitle);
require_once SERVER_ROOT . '/html/components/body_start.inc.php';
?>

<h1 class="py-3"><?php echo $pageTitle ?></h1>
<div class="accordion" id="accordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Adicionar Conta
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
            <div class="accordion-body">
                <form action="" method="post" >
                    <div class="row py-2">
                        <div class="col">
                            <label class="form-label" for="nome">Nome do Cliente</label>
                            <input
                                class="form-control"
                                type="text"
                                name="nome"
                                id="nome"
                                required
                            >
                            <?php if (!empty($erros['nomeCliente'])) { ?>
                                <div class="alert alert-danger py-1 my-1"><?php echo $erros['nomeCliente']; ?></div>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <label class="form-label" for="nif">NIF</label>
                            <input
                                class="form-control"
                                type="text"
                                inputmode="numeric"
                                name="nif"
                                id="nif"
                                pattern="\d{9}"
                                title="O número de contribuente deve ter 9 dígitos"
                                required
                            >
                            <?php if (!empty($erros['nif'])) { ?>
                                <div class="alert alert-danger py-1 my-1"><?php echo $erros['nif']; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <fieldset class="py-2">
                        <legend class="form-label" style="font-size: 1rem;">
                            Morada
                        </legend>
                        <div class="row">
                            <div class="col-2">
                                <input
                                    class="form-control"
                                    type="text"
                                    name="porta"
                                    id="porta"
                                    required
                                >
                                <label class="form-text text-muted" for="porta">Número de Porta</label>
                                <?php if (!empty($erros['porta'])) { ?>
                                    <div class="alert alert-danger py-1 my-1"><?php echo $erros['porta']; ?></div>
                                <?php } ?>
                            </div>
                            <div class="col-10">
                                <input
                                    class="form-control"
                                    type="text"
                                    name="rua"
                                    id="rua"
                                    required
                                >
                                <label class="form-text text-muted" for="rua">Rua</label>
                                <?php if (!empty($erros['rua'])) { ?>
                                    <div class="alert alert-danger py-1 my-1"><?php echo $erros['rua']; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </fieldset>

                    <div class="row py-2">
                        <div class="col-3">
                            <fieldset>
                                <legend class="form-label" style="font-size: 1rem;">
                                    Código Postal
                                </legend>
                                <div class="row">
                                    <div class="col-6">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="cp1"
                                            id="cp1"
                                            inputmode="numeric"
                                            pattern="\d{4}"
                                            title="Os quatros primeiros dígitos do código postal"
                                            required
                                        >
                                    </div>
                                    <div class="col-1">-</div>
                                    <div class="col-5">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="cp2"
                                            id="cp2"
                                            inputmode="numeric"
                                            pattern="\d{3}"
                                            title="Os três últimos dígitos do código postal"
                                            required
                                        >
                                    </div>
                                    <?php if (!empty($erros['cp'])) { ?>
                                        <div class="alert alert-danger py-1 my-1"><?php echo $erros['cp']; ?></div>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col">
                            <label for="localidade" class="form-label">
                                Localidade
                            </label>
                            <input
                                class="form-control"
                                type="text"
                                name="localidade"
                                id="localidade"
                                required
                            >
                            <?php if (!empty($erros['localidade'])) { ?>
                                <div class="alert alert-danger py-1 my-1"><?php echo $erros['localidade']; ?></div>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <label for="desconto" class="form-label">Desconto</label>
                            <input
                                class="form-control"
                                type="number"
                                name="desconto"
                                id="desconto"
                                min="0"
                                max="15"
                                value="0"
                                required
                            >
                            <?php if (!empty($erros['desconto'])) { ?>
                                <div class="alert alert-danger py-1 my-1"><?php echo $erros['desconto']; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col">
                            <input type="submit" class="btn btn-primary" value="Criar Conta">
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
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Lista de Contas
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
            <div class="accordion-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código de Cliente</th>
                            <th>Nome de Cliente</th>
                            <th>NIF</th>
                            <th>Morada</th>
                            <th>Código Postal</th>
                            <th>Localidade</th>
                            <th>Desconto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contas as $nif => $conta) { ?>
                            <tr>
                                <td><?php echo $conta['codigo']; ?>
                                <td><?php echo $conta['nome']; ?></td>
                                <td><?php echo $nif; ?></td>
                                <td><?php echo $conta['morada']; ?></td>
                                <td><?php echo $conta['cp'];?></td>
                                <td><?php echo $conta['localidade'];?></td>
                                <td><?php echo $conta['desconto'];?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once SERVER_ROOT . '/html/components/body_end.inc.php'; ?>

