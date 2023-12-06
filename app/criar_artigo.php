<?php

require_once '/app/pos_lib.php';

//ler Artigos
$artigos = lerArtigo();

//Adicionar clientes

$artigos = adicionarArtigo($artigos, $_POST['nome'], $_POST['preco'], $_POST['iva'], $_POST['barras']);

//guardar artigos

guardarArtigos($artigos);

header('Location: /index.php');
