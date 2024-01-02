<?php
require_once '../config/config.php';

session_start();

$_SESSION = [];
session_destroy();
setcookie('sessioncookie', '', time()-3600, '/html');

header('Location: ' . APP_ROOT  . '/html/login.php');

