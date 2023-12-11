<?php
    session_start();
    if (empty($_SESSION['autenticado'])) {
        header('Location: html/login.php');
        exit;
    }
