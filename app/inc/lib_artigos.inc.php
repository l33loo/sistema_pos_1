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