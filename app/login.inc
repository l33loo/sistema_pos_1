<?php

session_start();

if (!empty($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    header('Location: /index.php');
}

if (!empty($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $utilizadores = lerUtilizadores();
    $utilizadorEValido = validarUtilizador($email, $password, $utilizadores);
    
    if ($utilizadorEValido) {
        $_SESSION['autenticado'] = true;
        setcookie('sessioncookie', md5('mylogin'), time() + (60 * 60 * 24 * 30));
        header('Location: /index.php');
    } else {
        $mensagemErro = 'Utilizador ou palavra-passe incorrectos';
    }
}

function validarUtilizador(string $email, $pass, array $utilizadores): bool {
    if (!array_key_exists($email, $utilizadores)) {
        return false;
    }
    if ($pass === $utilizadores[$email]) {
        return true;
    }
    return false;
}

function lerUtilizadores(): array {
    $listaUtilizadores = [];

    $caminhoFicheiro = "../dados/utilizadores.txt";
    if (file_exists($caminhoFicheiro)) {
        $ficheiroUtilizadores = fopen($caminhoFicheiro, "r");
    } else {
        return $listaUtilizadores;
    }
    
    while (($linha = fgets($ficheiroUtilizadores)) !== false) {
        $utilizador = explode(";", trim($linha));
        $listaUtilizadores[trim($utilizador[0])] = trim($utilizador[1]);
    }

    return $listaUtilizadores;
}

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
