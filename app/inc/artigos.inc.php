<?php
// Lógica back-end para Artigos

require_once 'lib_artigos.inc.php';

$erros = [];
$artigos = lerArtigos();

if (isset($_POST['submit'])) {
    // Validar os campos do formulário
    if (empty(trim($_POST['nome']))) {
        $erros['nomeArtigo'] = 'Deve preencher o campo do Nome do artigo.';
    }

    if (empty(trim($_POST['preco']))) {
        $erros['preco'] = 'Deve preencher o campo do Preço Unitário';
    } elseif (!is_numeric(str_replace(',', '.', trim($_POST['preco'])))) {
        $erros['preco'] = 'O preço deve ser nos formatos 9999, 9999.0 ou 9999,0, até duas casas decimais.';
    } elseif (trim($_POST['preco']) < 0 || trim($_POST['preco']) > 9999999) {
        $erros['preco'] = 'O preço deve ser um valor (decimal ou não) entre 0 e 9999999.';
    }

    $iva = $_POST['iva'];
    if (empty(trim($_POST['iva']))) {
        $iva = 0;
    } elseif (trim($_POST['iva']) !== 0 || trim($_POST['iva']) !== 4 || trim($_POST['iva']) !== 9 || trim($_POST['iva']) !== 16) {
        $erros['iva'] = 'O valor do IVA deve ser 0, 4, 9, ou 16.';
    }

    if (count($erros) === 0) {
        $artigos = adicionarArtigo($artigos, $_POST['nome'], $_POST['preco'], $iva, $_POST['barras']);
        $guardado = guardarArtigos($artigos);

        if ($guardado) {
            $msgSucesso = 'Artigo "' . $_POST['nome'] . '" criado com sucesso';
        }
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