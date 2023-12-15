<?php
require_once '../config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . ROOT . '/app/lib/pos.lib.php';

//ler Artigos
$artigos = lerArtigos();

//Adicionar clientes

$artigos = adicionarArtigo($artigos, $_POST['nome'], $_POST['preco'], $_POST['iva'], $_POST['barras']);

//guardar artigos

guardarArtigos($artigos);

header('Location: ' . ROOT . '/');
