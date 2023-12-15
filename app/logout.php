<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

session_start();

$_SESSION = [];
session_destroy();
setcookie('sessioncookie', '', time()-1);

header('Location: ' . ROOT  . '/html/login.php');

