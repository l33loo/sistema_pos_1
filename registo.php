<html>
<body>

<?php

session_start();

$nome = $_POST ["nome"];
$preço = $_POST["preco"];
$erro = 0;

//Verifica se existem erros nos campos
//verifica se existe erros no $nome

if(empty($nome) or strstr ($nome, ' ' ) == FALSE)
    echo "Insira um nome válido"; $erro = 1;

//verifica se existem erros no $preço

if (empty($preço) or (!is_float($preço) or strstr ($preço, ' ' ) == FALSE))
    echo "Insira um valor válido"; $erro = 1;

//Verifica se existem erros no codigo de barras

if (empty($codigoBarras) or strlen($codigoBarras != 13) or strstr ($codigoBarras, ' ' ) == FALSE)
    echo "Insira um Código de Barras válido"; $erro = 1;

//Verifica se existem erros 

if($erro == 0)
    echo "Todos os campos foram preenchidos corretamente!";

//Abrir ficheiro
$nomeFicheiro = "artigos.txt";
if (file_exists($nomeFicheiro)) {
    $ficheiro = fopen($nomeFicheiro, "r");
} else {
    return [];
};




?>



</body>
</html>