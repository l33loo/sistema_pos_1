<?php
// Funções utilizadas em varios ficheiros

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

//adicionar um artigo
function adicionarArtigo(array $artigos, string $nome, string $preco, int $iva, string $barras, int $id = 0): array
{
    $artigo = [
        'codigo' => $id === 0 ? count($artigos) + 1 :$id,
        'nome' => $nome,
        'preco' => $preco,
        'iva' => $iva,
    ];

    $artigos[$barras] = $artigo;
    return $artigos;
 }