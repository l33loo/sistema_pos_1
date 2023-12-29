<?php
// Lógica back-end para Contas

require_once 'lib_contas.inc.php';

$contas = lerContas();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Verifica se todos os campos necessários estão presentes e não estão vazios
    if (
        !empty($_POST['nome']) &&
        !empty($_POST['nif']) &&
        !empty($_POST['porta']) &&
        !empty($_POST['rua']) &&
        !empty($_POST['cp1']) &&
        !empty($_POST['cp2']) &&
        !empty($_POST['localidade']) &&
        isset($_POST['desconto']) && // Certifica-se de que o desconto está definido
        is_numeric($_POST['desconto']) && // Certifica-se de que o desconto é um número
        $_POST['desconto'] >= 0 && $_POST['desconto'] <= 15 // Verifica se o desconto está no intervalo de 0 a 15
    ) {
        
        // Verifica se o desconto está no intervalo correto
        if ($_POST['desconto'] >= 0 && $_POST['desconto'] <= 15) {
        
            // Verifica se $cp1 e $cp2 têm o número correto de dígitos
            if (strlen($_POST['cp1']) === 4 && strlen($_POST['cp2']) === 3) {

                // Verifica se $nif tem o número correto de dígitos
                if (strlen($_POST['nif']) === 9) {

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
                        echo '<p class="alert alert-success">Conta Criada com Sucesso</p>';
                    } else {
                        echo '<p class="alert alert-danger">Erro a criar a conta</p>';
                    }

                } else {
                    echo '<p class="alert alert-danger">Por favor, preencha todos os campos do formulário corretamente</p>';
                }

                } else {
                    echo '<p class="alert alert-danger">Por favor, insira 9 dígitos para o NIF</p>';
                }
            } else {
                echo '<p class="alert alert-danger">Por favor, insira 4 dígitos para a primeira parte e 3 dígitos para a segunda parte do Código Postal</p>';
            }
    } else {
        echo '<p class="alert alert-danger">O desconto deve estar entre o 0 e o 15</p>';
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