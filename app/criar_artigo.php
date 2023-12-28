<?php
require_once '/config/config.php';
require_once SERVER_ROOT . '../app/inc/session.inc.php';
require_once SERVER_ROOT . '../app/inc/artigos.inc.php';


//ler Artigos
$artigos = lerArtigos();
if(array_key_exists($_POST['nome'], $artigos))
{
    echo "O nome do artigo já está a ser utilizado";
} elseif(array_key_exists($_POST['barras'], $artigos))
{
    echo" O código de barras já se encontra associado";
} else {
    //Adicionar artigos

    $artigos = adicionarArtigo($artigos, $_POST['nome'], $_POST['preco'], $_POST['iva'], $_POST['barras']);

//guardar artigos

guardarArtigos($artigos);

header('Location: ' . APP_ROOT . '/');
}

