<?php

function lerVendas(): array {
    $listaVendas = [];

    $caminhoFicheiro = "dados/vendas.txt";
    if (file_exists($caminhoFicheiro)) {
        $ficheiroVendas = fopen($caminhoFicheiro, "r");
    } else {
        return $listaVendas;
    }
    
    while (($linha = fgets($ficheiroVendas)) !== false) {
        $venda = explode(";", trim($linha));
        $listaVendas[$venda[0]] = array(
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