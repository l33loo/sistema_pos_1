<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Artigo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>

<?php
require_once('criarArtigo.php');

//adicionar um artigo
function adicionarArtigo(array $artigos, string $nome, int $preco, int $iva, string $barras, int $id = 0): array 
{ 
$artigo = [
    'codigo' => $id === 0 ? count($artigos) + 1 :$id,
    'nome' => $nome,
    'preco' => $preco,
    'iva' => $iva,
    'barras' => $barras,
];

    $artigos[] = $artigo;
    return $artigos;
 }


if(guardarArtigo($artigo)) { ?>
    <p class = "alert alert-success">Artigo adicionado com Sucesso</p>
<?php } else { ?>
    <p class = "alert alert-danger"> Erro ao adicionar Artigo</p>
<?php  };

//guarda um artigo

function guardarArtigo(array $artigo): bool
{
    $ficheiro = fopen("artigos.txt", "W") or die('Impossível abrir o ficheiro');
    
    $linha = implode(";", $artigo);

    $bytes = implode(";", $linha);

//fechar o ficheiro
    fclose($ficheiro);

    return $bytes === false ? false : true;
}

//ler artigos

    function lerArtigos(): array
    {
    $nomeFicheiro = "artigos.txt";
    if(file_exists($nomeFicheiro)) {
        $ficheiro = fopen($nomeFicheiro, "r");
    } else {
        return [];
    }
    
    $linha = fgets($ficheiro);
    if ($linha === false) {
        return [];
    }

    $artigo = explode(";", $linha);

    return [
        'codigo' => [],
        'nome' => $nome[0],
        'preco' => $preco[1],
        'iva' => $iva[2],
        'barras' => $barras[3],
    ];
 }
    
?>
    
</body>
</html>