<?php

// Определяем локально ли мы
$isLocal = ($_SERVER['SERVER_NAME'] === 'smmdonbass.local');

if ($isLocal) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $host = 'MySQL-5.7';
    $db   = 'smmdonbass_db';
    $user = 'root';
    $pass = '';

} else {

    // server params
    ini_set('display_errors', 0);
    error_reporting(E_ALL);

    $host = 'localhost';
    $db   = 'host1339344_smmdonbassdb';
    $user = 'host1339344_4524';
    $pass = 'X472Hmmc';

}


$pdo = new PDO(
    "mysql:host=$host;dbname=$db;charset=utf8mb4",
    $user,
    $pass,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);
$pdo->exec("SET NAMES utf8mb4");

// $pdo = new PDO(
//     "mysql:host=MySQL-5.7;dbname=smmdonbass_db;charset=utf8mb4",
//     "root",
//     "",
//     [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ]
// );
function e($value)
{
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function old($key)
{
    return $_POST[$key] ?? '';
}