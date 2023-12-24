<?php
require_once '../config/config.php';
require_once SERVER_ROOT . '/html/components/head.inc.php';

$pageTitle = 'Criação de Conta';

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
                <form action="<?php echo APP_ROOT . '/app/criar_conta.php' ?>" method="post" >
                    Nome do Cliente <input class="form-control form-control-lg" type="text" name="nome" id="">
                    <p style="color: grey;"> O nome deverá ser o nome completo.</p>
                    <br>
                    NIF<input class="form-control form-control-lg" type="number" name="nif" id="" minlength="9" maxlength="9">
                    <p style="color: grey;"> O NIF terá de ter apenas 9 digitos.</p>
                    <br>
                    Morada<input class="form-control form-control-lg" type="text" name="morada" id="">
                    <p style="color: grey;"> A Morada terá de ter a Rua e de seguida uma virgula com o número da Porta.</p>
                    <br>
                    <div>
                        <label for="cp1">Código Postal</label>
                        <div style="display: flex; align-items: center;">
                            <input class="form-control form-control-lg" style="min-width: 80px; max-width: 120px;" type="text" name="cp1" id="cp1" minlength="4" maxlength="4">
                            <span style="margin: 0 5px;">-</span>
                            <input class="form-control form-control-lg" style="min-width: 80px; max-width: 120px;" type="text" name="cp2" id="cp2" minlength="3" maxlength="3">
                        </div>
                        <p style="color: grey;"> O código postal terá de ter 4 caracteres no primeiro campo e 3 caracteres no segundo campo.</p>
                    </div>                                                       
                    <br>                    
                    Localidade<input class="form-control form-control-lg" type="text" name="localidade" id="">
                    <p style="color: grey;"> A localidade do client. Exemplo: Ponta Delgada</p>
                    <br>
                    Desconto<input class="form-control form-control-lg" type="number" name="desconto" id="">
                    <p style="color: grey;"> O desconto é apenas entre 0% e 15%.</p>
                    <br>
                    <button type="submit" class="btn btn-primary">Criar Conta</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>