<?php
session_start();
require_once './config/config.php';
require_once SERVER_ROOT . '/app/criar_artigo.php';
print_r($_POST);

$nome = trim($_POST["nome"]);
$preço = trim($_POST["preco"]);
$erro = 0;
$barras = trim($_POST["barras"]);
//Verifica se existem erros nos campos
//verifica se existe erros no $nome
if (empty($nome)) {
    echo "Insira um nome válido";
    $erro = 1;
}

//verifica se existem erros no $preço
if (empty($preço) || !is_float($preço)) {
    echo "Insira um valor válido";
    $erro = 1;
}

    //Verifica o codigo de barras    

function ean13CheckDigit(string $barras): string 
{
    //Adiciona o valor dos digitos nas posições ímpares
    $impar = $barras[1] + $barras[3] + $barras[5] + $barras[7] + $barras[9] + $barras[11];

    //Multiplica esse resultado por 3
    $produto = $impar * 3;

    //Adiciona os valores dos digitos nas posições pares

    $pares = $barras[0] + $barras[2] + $barras[4] + $barras[6] + $barras[8] + $barras[10]; 
    
    // soma o resultado de 2 com o resultado de 3
    $total = $produto + $pares;

    //verifica qual o menor numero de modo a que a sua soma seja um resultado multiplo de 10 

    $divide = (ceil($total / 10)) * 10;

    $verifica = $divide - $total;

    return $verifica;
}
$barras = 123123123123;
$ean13= ean13CheckDigit($barras);
$codigo_barras = $barras . $ean13;


if (empty($barras) || strlen($barras != 12) or strstr ($barras, ' ' ) == FALSE) {
    echo "Insira um Código de Barras válido";
    $erro = 1;
}

// Verifica se existem erros 
if ($erro == 0) {
    echo "Todos os campos foram preenchidos corretamente!";
}
?>