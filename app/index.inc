<?php
    session_start();
    if (empty($_SESSION['autenticado']) || $_SESSION['autenticado'] === false) {
        header('Location: /html/login.php');
        exit;
    }
