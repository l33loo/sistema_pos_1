<?php

//adicionar um artigo
function adicionarArtigo(array $artigos, string $nome, string $preco, int $iva, string $barras,int $id = 0): array 
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

 //guarda um artigo
function guardarArtigos(array $artigos): bool
{
    $ficheiro = fopen("artigos.txt", "w") or die('Impossível abrir o ficheiro');

    //escreve cada artigo da lista numa linha separando os 
    //itens desta mesma lista por ";"
    foreach ($artigos as $artigo) {
        $bytes = fwrite($ficheiro, implode(";", $artigo) . "\n");
        if ($bytes === false) {
            return false;
        }
    }

//fechar o ficheiro
    fclose($ficheiro);
    return true;
}

//ler artigos

    function lerArtigo(): array
    {

    $nomeFicheiro = "artigos.txt";
    if(file_exists($nomeFicheiro)) {
        $ficheiroArtigos = fopen($nomeFicheiro, "r");
    } else {
        return [];
    }
    
    $artigos = [];
    while(($linha = fgets($ficheiroArtigos)) !== false) {
        $artigo = explode(";", trim($linha));

        $artigos = adicionarArtigo($artigos, $artigo[1], $artigo[2], $artigo[3], $artigo[4], $artigo[0]);    
    }

    return $artigos;
}
?>