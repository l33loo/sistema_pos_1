<?php

session_start();

if (!empty($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $utilizadores = lerUtilizadores();
    $utilizadorEValido = validarUtilizador($email, $password, $utilizadores);
    
    if ($utilizadorEValido) {
        $_SESSION['autenticado'] = true;
        setcookie('sessioncookie', $email . '@' .  password_hash($password, PASSWORD_BCRYPT), time() + (60 * 60 * 24 * 30));
        header('Location: ' . APP_ROOT  . '/');
    } else {
        $mensagemErro = 'Utilizador ou palavra-passe incorrectos';
    }
} else {
    if (!empty($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
        header('Location: ' . APP_ROOT . '/');
    } else {
        if (!empty($_COOKIE['sessioncookie']) && $_COOKIE['sessioncookie'] === password_hash($password, PASSWORD_BCRYPT)) {
            $_SESSION['autenticado'] = true;
            setcookie('sessioncookie', $email . '@' .  password_hash($password, PASSWORD_BCRYPT), time() + (60 * 60 * 24 * 30));
            header('Location: '. APP_ROOT . '/');
        } else {
            setcookie('sessioncookie', '', time()-1);
        }
    }
}

function validarUtilizador(string $email, $pass, array $utilizadores): bool {
    if (!array_key_exists($email, $utilizadores)) {
        return false;
    }
    if (password_verify($pass, $utilizadores[$email])) {
        return true;
    }

    return false;
}

function lerUtilizadores(): array {
    $listaUtilizadores = [];

    $caminhoFicheiro = SERVER_ROOT . '/dados/utilizadores.txt';
    if (file_exists($caminhoFicheiro)) {
        $ficheiroUtilizadores = fopen($caminhoFicheiro, 'r');
    } else {
        return $listaUtilizadores;
    }
    
    while (($linha = fgets($ficheiroUtilizadores)) !== false) {
        $utilizador = explode(';', $linha);
        $listaUtilizadores[trim($utilizador[0])] = trim($utilizador[1]);
    }

    return $listaUtilizadores;
}