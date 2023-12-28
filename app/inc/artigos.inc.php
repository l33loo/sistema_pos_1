<?php

//adicionar um artigo
function adicionarArtigo(array $artigos, string $nome, string $preco, int $iva, string $barras, int $id = 0): array
{
    $artigo = [
        'codigo' => $id === 0 ? count($artigos) + 1 :$id,
        'nome' => $nome,
        'preco' => $preco,
        'iva' => $iva,
        'barras' => $barras,
    ];

    $artigos[$barras] = $artigo;
    return $artigos;
 }

 //guarda um artigo
function guardarArtigos(array $artigos): bool
{
    $ficheiro = fopen(SERVER_ROOT . '/dados/artigos.txt', 'w') or die('Impossível abrir o ficheiro');

    //escreve cada artigo da lista numa linha separando os 
    //itens desta mesma lista por ";"
    foreach ($artigos as $barras => $artigo) {
        $bytes = fwrite($ficheiro, implode(';', $artigo) . ';' . $barras . "\n");
        if ($bytes === false) {
            return false;
        }
    }

    //fechar o ficheiro
    fclose($ficheiro);
    return true;
}

function lerArtigos(): array
{

    $nomeFicheiro = SERVER_ROOT . '/dados/artigos.txt';
    if(file_exists($nomeFicheiro)) {
        $ficheiroArtigos = fopen($nomeFicheiro, 'r');
    } else {
        return [];
    }
    
    $artigos = [];
    while(($linha = fgets($ficheiroArtigos)) !== false) {
        $artigo = explode(';', trim($linha));
        
        $artigos = adicionarArtigo($artigos, $artigo[1], $artigo[2], $artigo[3], $artigo[4], $artigo[0]);
    }

    return $artigos;
}

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

//Verifica se o codigo de barras está correto
if (empty($barras) || strlen($barras != 12) or strstr ($barras, ' ' ) == FALSE) {
    echo "Insira um Código de Barras válido";
    $erro = 1;
}

// Verifica se existem erros 
if ($erro == 0) {
    echo "Todos os campos foram preenchidos corretamente!";
}
?>