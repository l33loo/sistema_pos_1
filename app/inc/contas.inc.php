<?php
// Lógica back-end para Contas

require_once 'lib_contas.inc.php';

// Re-inicializar mensagems de sucesso e erro
$successMsg = '';
$erros = [];

$contas = lerContas();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar os campos do formulário
    if (empty(trim($_POST['nome']))) {
        $erros['nomeCliente'] = 'Deve preecher o campo do Nome do cliente.';
    }

    if (empty(trim($_POST['nif'])) || !preg_match('/^[0-9]{9}$/', trim($_POST['nif']))) {
        $erros['nif'] = 'O NIF dever ter 9 dígitos.';
    } elseif (array_key_exists(trim($_POST['nif']), $contas)) {
        $erros['nif'] = 'A conta "' . trim($_POST['nif']) . '" já existe.';
    }

    if (empty(trim($_POST['porta']))) {
        $erros['porta'] = 'Deve preencher o campo do número de porta.';
    }

    if (empty(trim($_POST['rua']))) {
        $erros['rua'] = 'Deve preencher o campo da rua.';
    }

    if (empty(trim($_POST['cp1']))
        || empty(trim($_POST['cp2']))
        || !preg_match('/^[0-9]{4}$/', trim($_POST['cp1']))
        || !preg_match('/^[0-9]{3}$/', trim($_POST['cp2']))
    ) {
        $erros['cp'] = 'O código postal deve ter 4 dígitos no primeiro campo, e 3 dígitos no segundo campo.';
    }

    if (empty(trim($_POST['localidade']))) {
        $erros['localidade'] = 'Deve preencher o campo da localidade.';
    }

    if (!isset($_POST['desconto']) // Certifica-se de que o desconto está definido
        || !is_numeric(trim($_POST['desconto'])) // Certifica-se de que o desconto é um número
        || trim($_POST['desconto']) < 0
        || trim($_POST['desconto']) > 15 // Verifica se o desconto está no intervalo de 0 a 15
    ) { 
        $erros['desconto'] = 'O desconto deve ser entre 0 e 15.';
    }

    if (count($erros) === 0) {
        // Dados do cliente com o número de ordem
        $cliente = [
            'numero_ordem' => count($contas) + 1, // Inteiro sequencial único a cada cliente
            'nome' => trim($_POST['nome']), 
            'nif' => trim($_POST['nif']), // Cadeira de caracteres de dimensão 9 contendo apenas dígitos
            // Cadeira de caracteres contendo a rua e o número de porta separados por vírgula (,)
            'morada' => trim($_POST['rua']) . ', ' . trim($_POST['porta']),
            'cp' => trim($_POST['cp1']) . '-' . trim($_POST['cp2']),  // Formato: XXXX-YYY
            'localidade' => trim($_POST['localidade']),
            'desconto' => trim($_POST['desconto']),  // Entre 0-15
        ];

        // Chama a função para guardar o cliente
        if (guardarConta($cliente)) {
            $successMsg = 'Conta do Cliente ' . trim($_POST['nif']) . ' criada com Sucesso';
        } else {
            $erros['guardar'] = 'Erro a criar a conta ' . trim($_POST['nif']);
        }
    }
}

// Função para guardar a conta no arquivo CSV
function guardarConta(array $conta): bool
{
    $csvFileName = SERVER_ROOT . '/dados/contas.txt';
    if (!file_exists($csvFileName)) {
        return false;
    }

    $file = fopen($csvFileName, 'a');
    if ($file === false) {
        return false;
    }
 
    // Concatena os valores com ponto e vírgula e escreve no arquivo
    fwrite($file, implode(';', $conta) . "\n");
    fclose($file);
    return true;
}

