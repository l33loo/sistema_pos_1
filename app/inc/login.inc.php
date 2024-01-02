<?php

session_start();

if (!empty($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $utilizadorEValido = validarUtilizadorNoLogin($email, $password);
    
    if ($utilizadorEValido) {
        $passHash = password_hash($password, PASSWORD_BCRYPT);
        handleAuthenticatedUser($email);
    } else {
        $mensagemErro = 'Utilizador ou palavra-passe incorrectos';
    }
} elseif (!empty($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    header('Location: ' . APP_ROOT . '/');
// Verificar se há um session cookie contendo credenciais de utilizador validos
} elseif (!empty($_COOKIE['sessioncookie']) && validarSessionCookie($_COOKIE['sessioncookie'])) {
    $creds = getCredsFromSessionCookie($_COOKIE['sessioncookie']);
    handleAuthenticatedUser($creds['email']);
} else {
    $_SESSION = [];
    session_destroy();
    setcookie('sessioncookie', '', time()-3600, '/html');
}

function validarUtilizadorNoLogin(string $email, string $pass): bool
{
    $utilizadores = lerUtilizadores();
    if (!array_key_exists($email, $utilizadores)) {
        return false;
    }
    if (password_verify($pass, $utilizadores[$email])) {
        return true;
    }

    return false;
}

function lerUtilizadores(): array
{
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

function validarSessionCookie(string $cookie): bool
{
    $utilizadores = lerUtilizadores();    
    $creds = getCredsFromSessionCookie($cookie);
    if (!array_key_exists($creds['email'], $utilizadores)) {
        return false;
    }
    
    return $utilizadores[$creds['email']] === $creds['passHash'];
}

function getCredsFromSessionCookie(string $cookie): array
{
    $array = explode('@', $cookie, 3);
    $email = $array[0] . '@' . $array[1];
    $pass = $array[2];

    return array(
        'email' => $email,
        'passHash' => $pass,
    );
}

function setSessionCookie(string $email, string $pass): void
{
    setcookie('sessioncookie', $email . '@' .  $pass, time() + (60 * 60 * 24 * 30));
}

function handleAuthenticatedUser(string $email): void
{
    $_SESSION['autenticado'] = true;
    $utilizadores = lerUtilizadores();
    setSessionCookie($email, $utilizadores[$email]);
    header('Location: '. APP_ROOT . '/');
}