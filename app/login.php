<?php

session_start();

if (!empty($_POST['login'])) {

}

include('../html/login.php');

function validarUtilizador(string $email, $pass): bool {
    return true;
}

function lerUtilizadores(): array {
    $listaUtilizadores = [];

    $caminhoFicheiro = "../dados/utilizadores.txt";
    if (file_exissts($caminhoFicheiro)) {
        $ficheiroUtilizadores = fopen($caminhoFicheiro, "r");
    } else {
        return $listaUtilizadores;
    }
    
    while (($linha = fgets($caminhoFicheiro)) !== false) {
        $utilizador = explode(";", trim($linha));
        $listaUtilizadores[$utilizador[0]] = $utilizador[1];
    }

    return $listaUtilizadores;
}

// function lerMovimentos(array $conta): array
// {
//     $nomeFicheiro = "movimentos.csv";
//     if (file_exists($nomeFicheiro)) {
//         $ficheiroMovimentos = fopen($nomeFicheiro, "r");
//     } else {
//         return $conta;
//     }
    
//     while (($linha = fgets($ficheiroMovimentos)) !== false) {
//         $movimento = explode(";", trim($linha));

//         // se for um movimento do tipo C fazem um deposito
//         // se for um movimento do D fazem um levantamento
//         if ($movimento[1] == 'C') {
//             $conta = depositar($conta, $movimento[2], $movimento[0]);
//         } elseif ($movimento[1] == 'D') {
//             $conta = levantar($conta, $movimento[2], $movimento[0]);
//         } else {
//             echo "Ficheiro com dados incorrectos: Tipo de operação desconhecido\n";
//             exit;
//         }
//     }

//     return $conta;
// }



// <?php
//     session_start();

//     if (!empty($_POST['login_b'])) {
//         if ('jose@gmail.com' == $_POST['email'] && $_POST['password'] == 'picanha') {
//             $_SESSION['autenticado'] = true;
//             setcookie('sessioncookie', md5('mylogin'), time() + (60 * 60 * 24 * 30));
//             header('Location: home.php');
//         } else {
//             $mensagem = 'Uitlizador ou palavra-passe incorrectos';
//         }    
//     } else {
//         if (!empty($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
//             header('Location: home.php');
//         } else {
//             if (!empty($_COOKIE['sessioncookie']) && $_COOKIE['sessioncookie'] == md5('mylogin')) {
//                 $_SESSION['autenticado'] = true;
//                 setcookie('sessioncookie', md5('mylogin123'), time() + (60 * 60 * 24 * 30));
//                 header('Location: home.php');
//             } else {
//                 setcookie('sessioncookie', '', time()-1);
//             }
//         }
//     }
// ?>

// <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Document</title>
// </head>
// <body>
//     <?php if (!empty($mensagem) ) { echo '<h3 style="color: red">' . $mensagem . "</h3>"; } ?>
//     <form action="" method="post">
//         Email: <input type="email" name="email" id="" placeholder="introduza o seu email" required><br>
//         Password: <input type="password" name="password" id="" placeholder="escreva a sua password" required><br>
//         <input type="submit" value="Iniciar Sessão" name="login_b">
//     </form>

// </body>
// </html>
