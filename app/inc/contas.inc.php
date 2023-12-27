<?php
// Função para guardar a conta no arquivo CSV
function guardarConta(array $conta): bool {
    $csvFileName = SERVER_ROOT . '/dados/contas.txt';
    $file = fopen($csvFileName, 'a'); 
    if ($file) {
        // Concatena os valores com ponto e vírgula e escreve no arquivo
        fwrite($file, implode(';', $conta));
        fclose($file);
        return true;
    } else {
        return false;
    }
}

function gerarCodigoCliente(): int {
    // Inicia ou recupera o contador de clientes a partir do arquivo CSV
    $csvFileName = SERVER_ROOT . '/dados/contas.csv';
    $contadorClientes = 0;

    if (($handle = fopen($csvFileName, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ';')) !== false) {
            $contadorClientes++;
        }
        fclose($handle);
    }

    return $contadorClientes;
}

function lerContas(): array {
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
            'nomeCliente' => $conta[1],
            'morada' => $conta[3],
            'codigoPostal' => $conta[4],
            'localidade' => $conta[5],
            'desconto' => $conta[6],
        );
    }

    return $listaContas;
}

function lerConta(int $contribuente): array {
    $contas = lerContas();
    
    if (!array_key_exists($contribuente, $contas)) {
        return [];
    }

    return $contas[$codigo];
}

function adicionarConta(array $contas, string $nomeCliente, string $nif, string $morada, string $codigoPostal, string $localidade, int $desconto, int $codigo): array
{
    $conta = [
        'nome' => $conta[1],
        'nif' => $conta[2],
        'morada' => $conta[3],
        'cp' => $conta[4],
        'localidade' => $conta[5],
        'desconto' => $conta[6],
    ];

    $contas[$codigo] = $conta;
    return $contas;
 }