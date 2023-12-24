<?php

if (!empty($_POST)) {
    if (empty($_POST['barras'])) {
        // error
        echo 'barras wrong';
    }
    
    if (empty($_POST['quantidade'])) {
        // error
        echo 'quantidade wrong';
    }

    if (!empty($_POST['barras']) && !empty($_POST['quantidade'])) {
        // validate types
        $artigos = lerArtigos();

        if (!array_key_exists($_POST['barras'], $artigos)) {
            // error
            echo 'barras does not exist';
        } else {
            $artigo = $artigos[$_POST['barras']];
            $vendas = adicionarVenda(lerVendas(), $artigo['codigo'], $artigo['nome'], $_POST['quantidade'], $artigo['preco'], $artigo['iva']);
            $guardado = guardarVendas($vendas);

            if (!$guardado) {
                // error
                echo 'error saving';
            } else {
                // success message
                echo 'venda added with success <3';
            }
        }
    }
}

function lerVendas(): array {
    $listaVendas = [];

    $caminhoFicheiro = SERVER_ROOT . '/dados/venda.txt';
    if (!file_exists($caminhoFicheiro)) {
        echo 'ler: file doesnt exist';
        return $listaVendas;
    }

    $ficheiroVendas = fopen($caminhoFicheiro, 'r');
    
    while (($linha = fgets($ficheiroVendas)) !== false) {
        $venda = explode(";", trim($linha));
        $listaVendas[] = array(
            "codigo" => $venda[0],
            "nome" => $venda[1],
            "quantidade" => $venda[2],
            "precoUni" => $venda[3],
            "iva" => $venda[4],
            "cliente" => $venda[5],
            "desconto" => $venda[6],
        );
    }

    return $listaVendas;
}

function adicionarVenda(array $listaVendas, int $codigo, string $nome, float $quantidade, string $precoUnitario, int $iva, int $cliente = 0, int $desconto = 0): array {
    $listaVendas[] = array(
        "codigo" => $codigo,
        "nome" => $nome,
        "quantidade" => $quantidade,
        "precoUni" => $precoUnitario,
        "iva" => $iva,
        "cliente" => $cliente,
        "desconto" => $desconto,
    );

    return $listaVendas;
}

function guardarVendas(array $listaVendas): bool {
    $caminhoFicheiro = SERVER_ROOT . '/dados/venda.txt';
    if (!file_exists($caminhoFicheiro)) {
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