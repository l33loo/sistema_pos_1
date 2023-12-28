<?php
// Lógica back-end para Artigos

require_once 'lib_artigos.inc.php';

$artigos = lerArtigos();
if (isset($_POST['submit'])) {
    // TODO: validate fields + errors
    $artigos = adicionarArtigo($artigos, $_POST['nome'], $_POST['preco'], $_POST['iva'], $_POST['barras']);
    $guardado = guardarArtigos($artigos);

    if ($guardado) {
        $msgSucesso = 'Artigo "' . $_POST['nome'] . '" criado com sucesso';
    }
}

 //guarda um artigo
function guardarArtigos(array $artigos): bool
{
    $ficheiro = fopen(SERVER_ROOT . '/dados/artigos.txt', 'w') or die('Impossível abrir o ficheiro');

    //escreve cada artigo da lista numa linha separando os 
    //itens desta mesma lista por ";"
    foreach ($artigos as $barras => $artigo) {
        $bytes = fwrite($ficheiro, implode(';', $artigo) . ';' . $barras . "\n");
        if ($bytes === false) {
            return false;
        }
    }

    //fechar o ficheiro
    fclose($ficheiro);
    return true;
}
?>