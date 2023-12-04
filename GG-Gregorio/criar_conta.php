<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Nova Conta de Usuário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>

<?php

// Função para guardar a conta no arquivo CSV
function guardar($conta) {
    $csvFileName = 'contas.csv';
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

// Inicia ou recupera o contador de clientes a partir do arquivo CSV
$csvFileName = 'contas.csv';
$contadorClientes = 0;

if (($handle = fopen($csvFileName, 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ';')) !== false) {
        $contadorClientes++;
    }
    fclose($handle);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Verifica se todos os campos necessários estão presentes e não estão vazios
    if (
        !empty($_POST['nome']) &&
        !empty($_POST['nif']) &&
        !empty($_POST['morada']) &&
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
                
                    // Incrementa o contador global de clientes
                    $contadorClientes++;

                    // Dados do cliente com o número de ordem
                    $cliente = [
                        'numero_ordem' => $contadorClientes, // Inteiro sequencial único a cada cliente
                        'nome' => $_POST['nome'], 
                        'nif' => $_POST['nif'], // Cadeira de caracteres de dimensão 9 contendo apenas dígitos
                        'morada' => $_POST['morada'], 
                        'cp' => $_POST['cp1'] . '-' . $_POST['cp2'],  // Formato: XXXX-YYY
                        'localidade' => $_POST['localidade'],
                        'desconto' => $_POST['desconto'],  // Entre 0-15
                    ];

                    // Chama a função para guardar o cliente
                    if (guardar($cliente)) {
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

?>











</body>
</html>