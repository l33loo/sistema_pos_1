<?php
require_once '../config/config.php';
require_once SERVER_ROOT . '/app/inc/contas.inc.php';
require_once SERVER_ROOT . '/html/components/head.inc.php';

$pageTitle = 'Contas';

// HTML
echo getHeader($pageTitle);
include(SERVER_ROOT . '/html/components/body_start.inc.php');
?>

        <div class="row mt-3">
            <div class="col">
                <h1><?php echo $pageTitle ?></h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
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
                            >
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col">
                            <input type="submit" class="btn btn-primary" value="Criar Conta">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>