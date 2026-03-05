<?php
session_start();

// Удаляем все данные сессии
$_SESSION = [];

// Уничтожаем сессию
session_destroy();

// Перенаправляем на главную
header("Location: /");
exit;