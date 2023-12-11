<?php

session_start();

$_SESSION = [];
session_destroy();
setcookie('sessioncookie', '', time()-1);

header('Location: /html/login.php');

