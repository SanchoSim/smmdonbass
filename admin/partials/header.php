<?php
session_start();
require_once __DIR__ . '/../../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Админ-панель – SMM Donbass</title>

<!-- Подключаем основной CSS -->
<!-- <link rel="stylesheet" href="../css/style.css"> -->
<link rel="stylesheet" href="../css/style.css?v=<?= filemtime('../css/style.css') ?>">


</head>
<body>

<header class="hero small">
    <h1>Админ-панель</h1>
<div>
    <a class="btn" href="dashboard.php">← Назад</a>
    <a class="btn btn-edit" href="change_password.php">Пароль</a>
    <a class="btn btn-logout" href="logout.php">Выйти</a>
</div>
</header>

<div class="form-wrapper"></div>