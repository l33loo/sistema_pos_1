<?php
require_once '../config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/head.inc.php';

// HTML
echo getHeader('Adicionar novo artigo');
include($_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/nav.inc.php');
?>

<h1>Registo de artigo</h1>
<form action="/app/criar_artigo.php" method="post">
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
    <button type="submit" class="btn btn-primary">Registar Artigo</button>
    <enctype="multipart/form-data"></enctype>
</form>

<?php include($_SERVER['DOCUMENT_ROOT'] . ROOT . '/html/components/end.inc.php'); ?>