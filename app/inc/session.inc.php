<?php
    session_start();
    if (empty($_SESSION['autenticado']) || $_SESSION['autenticado'] === false) {
        header('Location: ' . ROOT . '/html/login.php');
        exit;
    }
