<?php
require_once '/config/config.php';

session_start();

$_SESSION = [];
session_destroy();
setcookie('sessioncookie', '', time()-1);

header('Location: ' . APP_ROOT  . '/html/login.php');
