<?php
// Funções utilizadas em varios ficheiros

function lerContas(): array
{
    $listaContas = [];

    $caminhoFicheiro = SERVER_ROOT . "/dados/contas.txt";
    if (file_exists($caminhoFicheiro)) {
        $ficheiroContas = fopen($caminhoFicheiro, "r");
    } else {
        return $listaContas;
    }
    
    while (($linha = fgets($ficheiroContas)) !== false) {
        $conta = explode(";", trim($linha));
        $listaContas[$conta[2]] = array(
            'codigo' => $conta[0],
            'nome' => $conta[1],
            'morada' => $conta[3],
            'cp' => $conta[4],
            'localidade' => $conta[5],
            'desconto' => $conta[6],
        );
    }

    return $listaContas;
}

// Um número de contribuente "null" é igual ao Consumidor Final
function lerConta(?string $contribuente): array
{
    $contas = lerContas();

    if (!$contribuente) {
        $contribuente_consumidor_final = '999999990';
        if (!array_key_exists($contribuente_consumidor_final, $contas)) {
            return [];
        }

        $conta = $contas[$contribuente_consumidor_final];
        $conta['contribuente'] = $contribuente_consumidor_final;

        return $conta;
    }
    
    if (!array_key_exists($contribuente, $contas)) {
        return [];
    }

    $conta = $contas[$contribuente];
    $conta['contribuente'] = $contribuente;

    return $conta;
}
