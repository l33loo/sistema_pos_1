<?php
require_once 'lib_artigos.inc.php';
require_once 'lib_contas.inc.php';

$erros = [];

if (!empty($_POST)) {
    if (empty($_POST['barras']) || !preg_match('/^[0-9]{13}$/', $_POST['barras'])) {
        $erros['barras'] = 'O campo do código de barras dever ter 13 dígitos.';
    }
    
    if (empty($_POST['quantidade']) || !is_numeric($_POST['quantidade'])) {
        $erros['quantidade'] = 'Deve especificar uma quantidade.';
    }

    if (!empty($_POST['contribuente']) && !preg_match('/^[0-9]{9}$/', $_POST['contribuente'])) {
        $erros['contribuente'] = 'O contribuente deve ter 9 dígitos.';
    } else {
        $conta = lerConta($_POST['contribuente']);
        if (count($conta) === 0) {
            $erros['contribuente'] = 'O cliente "' . $_POST['contribuente'] . '" não existe.';
        }
    }
    
    if (count($erros) === 0) {
        // validate types
        $artigos = lerArtigos();

        if (!array_key_exists($_POST['barras'], $artigos)) {
            $erros['barras'] = 'O artigo "' . $_POST['barras'] . '" não existe.';
        } else {
            $artigo = $artigos[$_POST['barras']];
            $vendas = adicionarVenda(lerVendas(), $artigo['codigo'], $artigo['nome'], $_POST['quantidade'], $artigo['preco'], $artigo['iva'], $conta['codigo']);

            if (guardarVendas($vendas)) {
                $successMsg = 'Venda realizada com successo.';
            } else {$errorMsg = 'error saving';
                $erros['guardar'] = 'Erro com a venda.';
            }
        }
    }
}

function lerVendas(): array {
    $listaVendas = [];

    $caminhoFicheiro = SERVER_ROOT . '/dados/venda.txt';
    if (!file_exists($caminhoFicheiro)) {
        // create file if doesn't exist
        echo 'ler: file doesnt exist';
        return $listaVendas;
    }

    $ficheiroVendas = fopen($caminhoFicheiro, 'r');
    
    while (($linha = fgets($ficheiroVendas)) !== false) {
        $venda = explode(";", trim($linha));
        $listaVendas[] = array(
            'codigo' => $venda[0],
            'nome' => $venda[1],
            'quantidade' => $venda[2],
            'precoUni' => $venda[3],
            'iva' => $venda[4],
            'cliente' => $venda[5],
            'desconto' => $venda[6],
        );
    }

    return $listaVendas;
}

function adicionarVenda(array $listaVendas, int $codigo, string $nome, float $quantidade, string $precoUnitario, int $iva, int $cliente, int $desconto = 0): array {
    $listaVendas[] = array(
        'codigo' => $codigo,
        'nome' => $nome,
        'quantidade' => $quantidade,
        'precoUni' => $precoUnitario,
        'iva' => $iva,
        'cliente' => $cliente,
        'desconto' => $desconto,
    );

    return $listaVendas;
}

function guardarVendas(array $listaVendas): bool {
    $caminhoFicheiro = SERVER_ROOT . '/dados/venda.txt';
    if (!file_exists($caminhoFicheiro)) {
        // fix error
        echo 'guardar: file doesnt exist';
        return false;
    }

    $ficheiroVendas = fopen($caminhoFicheiro, 'w');

    foreach ($listaVendas as $venda) {
        $bytes = fwrite($ficheiroVendas, implode(';', $venda) . "\n");
        if ($bytes === false) {
            return false;
        }
    }

    fclose($ficheiroVendas);
    return true;
}

function vendasDaConta(?string $contribuente): array {
    $conta = lerConta($contribuente);
    $vendas = lerVendas();
    $vendasDaConta = [];
    foreach ($vendas as $venda) {
        if ($venda['cliente'] === $conta['codigo']) {
            $vendasDaConta[] = $venda;
        }
    }
    return $vendasDaConta;
}