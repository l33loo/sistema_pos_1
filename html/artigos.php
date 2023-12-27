<?php
require_once '../config/config.php';
require_once SERVER_ROOT . '/app/inc/session.inc.php';
require_once SERVER_ROOT . '/html/components/head.inc.php';

$pageTitle = 'Adicionar um novo artigo';

// HTML
echo getHeader($pageTitle);
include(SERVER_ROOT . '/html/components/body_start.inc.php');
?>

<h1><?php echo $pageTitle; ?></h1>
<form action="<?php echo APP_ROOT . '/app/criar_artigo.php' ?>" method="post">
    Nome do artigo: <input class="form-control form-control-lg" type="text" name="nome" maxlength="12"><br>
    Preço Unitário: <input  class="form-control form-control-lg" type="text" name="preco" required><br>
    <label for="iva"> Escolha a taxa de IVA</label>
    <select name="iva" id="iva">
        <option value="0">0</option>
        <option value="4">4</option>
        <option value="9">9</option>
        <option value="16">16</option>
    </select> </br> </br>
    Código de barras <input class="form-control form-control-lg" type="text" name="barras" maxlength="12" minlength="12" required>
    <br>
    <button type="submit" class="btn btn-primary">Registar Artigo</button>
    <enctype="multipart/form-data"></enctype>
</form>

<?php include(SERVER_ROOT . '/html/components/body_end.inc.php'); ?>
