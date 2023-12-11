<html>
<body>

<?php

session_start();

print_r($_POST);

$nome = trim($_POST["nome"]);
$preço = trim($_POST["preco"]);
$erro = 0;

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

function ean13CheckDigit(string $digitos): string 
{
    //Adiciona o valor dos digitos nas posições ímpares
    $impar = $digitos[1] + $digitos[3] + $digitos[5] + $digitos[7] + $digitos[9] + $digitos[11];

    //Multiplica esse resultado por 3
    $produto = $impar * 3;

    //Adiciona os valores dos digitos nas posições pares

    $pares = $digitos[0] + $digitos[2] + $digitos[4] + $digitos[6] + $digitos[8] + $digitos[10]; 
    
    // soma o resultado de 2 com o resultado de 3
    $total = $produto + $pares;

    //verifica qual o menor numero de modo a que a sua soma seja um resultado multiplo de 10 

    $divide = (ceil($total / 10)) * 10;

    $verifica = $divide - $total;

    return $verifica;

}

if (empty($codigoBarras) || strlen($codigoBarras != 12) or strstr ($codigoBarras, ' ' ) == FALSE) {
    echo "Insira um Código de Barras válido";
    $erro = 1;
}

// Verifica se existem erros 
if ($erro == 0) {
    echo "Todos os campos foram preenchidos corretamente!";
}
?>
</body>
</html>