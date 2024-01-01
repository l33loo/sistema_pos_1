<?php
// Lógica back-end para Artigos

require_once 'lib_artigos.inc.php';

// Re-inicializar mensagems de sucesso e erro
$msgSucesso = '';
$erros = [];

$artigos = lerArtigos();

if (isset($_POST['submit'])) {
    // Validar os campos do formulário
    if (empty(trim($_POST['nome']))) {
        $erros['nomeArtigo'] = 'Deve preencher o campo do Nome do artigo.';
    }

    if (empty(trim($_POST['preco']))) {
        $erros['preco'] = 'Deve preencher o campo do Preço Unitário';
    } elseif (!is_numeric(trim($_POST['preco']))) {
        $erros['preco'] = 'O preço deve ser nos formatos "9999" ou "9999.0", até duas casas decimais.';
    } elseif (trim($_POST['preco']) < 0 || trim($_POST['preco']) > 9999999) {
        $erros['preco'] = 'O preço deve ser um valor (decimal ou não) entre 0 e 9999999.';
    }

    if (!isset($_POST['iva'])) {
        $iva = 0;
    } elseif (
        trim($_POST['iva']) != 0
        && trim($_POST['iva']) != 4
        && trim($_POST['iva']) != 9
        && trim($_POST['iva']) != 16
    ) {
        $erros['iva'] = 'O valor do IVA deve ser 0, 4, 9, ou 16.';
    } else {
        $iva = trim($_POST['iva']);
    }

    if (empty(trim($_POST['barras']))) {
        $erros['barras'] = 'Deve preencher o campo do Código de barras';
    } elseif (!is_numeric(trim($_POST['barras'])) || strlen(trim($_POST['barras'])) !== 12) {
        $erros['barras'] = 'O Código de barras deve ter 12 dígitos.';
    }

    if (count($erros) === 0) {
        $barras = trim($_POST['barras']) . ean13CheckDigit(trim($_POST['barras']));

        if (array_key_exists($barras, $artigos)) {
            $erros['barras'] = 'O Código de barras "' . trim($_POST['barras']) . '" já existe.';
        }

        $artigos = adicionarArtigo($artigos, trim($_POST['nome']), trim($_POST['preco']), $iva, $barras);

        if (guardarArtigos($artigos)) {
            $msgSucesso = 'Artigo "' . trim($_POST['nome']) . '" criado com sucesso';
        } else {
            $erros['guardar'] = 'Erro a criar a artigo "' . trim($_POST['nome']);
        }
    }    
}

 //guarda um artigo
function guardarArtigos(array $artigos): bool
{
    $caminhoFicheiro = SERVER_ROOT . '/dados/artigos.txt';
    if (!file_exists($caminhoFicheiro)) {
        return false;
    }

    $ficheiro = fopen($caminhoFicheiro, 'w');
    if ($ficheiro === false) {
        return false;
    }

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

function ean13CheckDigit(string $digits): string
{
    // 1. Add the values of the digits in the even-numbered positions: 2, 4, 6, etc.
    $even_sum = $digits[1] + $digits[3] + $digits[5] + $digits[7] + $digits[9] + $digits[11];
    // 2. Multiply this result by 3.
    $even_sum_three = $even_sum * 3;
    // 3. Add the values of the digits in the odd-numbered positions: 1, 3, 5, etc.
    $odd_sum = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8] + $digits[10];
    // 4. Sum the results of steps 2 and 3.
    $total_sum = $even_sum_three + $odd_sum;
    // 5. The check character is the smallest number which, when added to the result in step 4,
    $next_ten = (ceil($total_sum / 10)) * 10;
    $check_digit = $next_ten - $total_sum;
    return $check_digit;
}