<?php
    session_start();
    if (empty($_SESSION['autenticado']) || $_SESSION['autenticado'] === false) {
        header('Location: ' . APP_ROOT . '/html/login.php');
        exit;
    }
