<?php
// Lógica back-end para Contas

require_once 'lib_contas.inc.php';

$erros = [];
$contas = lerContas();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['nome'])) {
        $erros['nomeCliente'] = 'Deve preecher o campo do Nome do cliente.';
    }

    if (empty($_POST['nif']) || !preg_match('/^[0-9]{9}$/', $_POST['nif'])) {
        $erros['nif'] = 'O NIF dever ter 9 dígitos.';
    }

    if (empty($_POST['porta'])) {
        $erros['porta'] = 'Deve preencher o campo do número de porta.';
    }

    if (empty($_POST['rua'])) {
        $erros['rua'] = 'Deve preencher o campo da rua.';
    }

    if (empty($_POST['cp1'])
        || empty($_POST['cp2'])
        || !preg_match('/^[0-9]{4}$/', $_POST['cp1'])
        || !preg_match('/^[0-9]{3}$/', $_POST['cp2'])
    ) {
        $erros['cp'] = 'O código postal deve ter 4 dígitos no primeiro campo, e 3 dígitos no segundo campo.';
    }

    if (empty($_POST['localidade'])) {
        $erros['localidade'] = 'Deve preencher o campo da localidade.';
    }

    if (!isset($_POST['desconto']) // Certifica-se de que o desconto está definido
        || is_numeric($_POST['desconto']) // Certifica-se de que o desconto é um número
        || $_POST['desconto'] <= 0
        || $_POST['desconto'] >= 15 // Verifica se o desconto está no intervalo de 0 a 15
    ) { 
        $erros['desconto'] = 'O desconto deve ser entre 0 e 15.';
    }

    if (count($erros) === 0) {
        // Dados do cliente com o número de ordem
        $cliente = [
            'numero_ordem' => count($contas) + 1, // Inteiro sequencial único a cada cliente
            'nome' => $_POST['nome'], 
            'nif' => $_POST['nif'], // Cadeira de caracteres de dimensão 9 contendo apenas dígitos
            // Cadeira de caracteres contendo a rua e o número de porta separados por vírgula (,)
            'morada' => $_POST['rua'] . ', ' . $_POST['porta'],
            'cp' => $_POST['cp1'] . '-' . $_POST['cp2'],  // Formato: XXXX-YYY
            'localidade' => $_POST['localidade'],
            'desconto' => $_POST['desconto'],  // Entre 0-15
        ];

        // Chama a função para guardar o cliente
        if (guardarConta($cliente)) {
            $successMsg = 'Conta do Cliente ' . $_POST['nif'] . ' criada com Sucesso';
        } else {
            $erros['guardar'] = 'Erro a criar a conta ' . $_POST['nif'];
        }
    }
}

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