<?php
    session_start();
    if (empty($_SESSION['autenticado'])) {
        header('Location: /app/login.php');
        exit;
    }

    include('./html/index.php');