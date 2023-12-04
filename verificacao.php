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

if (empty($preço) || !is_float($preço))
    echo "Insira um valor válido"; $erro = 1;

// Verifica se existem erros no codigo de barras
if (empty($codigoBarras) || strlen($codigoBarras != 13) or strstr ($codigoBarras, ' ' ) == FALSE) {
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