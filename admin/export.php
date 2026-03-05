<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Заголовки для скачивания файла
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=resources_export.csv');

// Открываем поток вывода
$output = fopen('php://output', 'w');

// BOM для корректного открытия в Excel
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Заголовки колонок
fputcsv($output, [
    'Название',
    'URL',
    'Статус',
    'Платформа',
    'Категория',
    'Тип',
    'Подписчики',
    'Описание',
    'Приоритет',
    'Цена',
    'Цена закрепа'
], ';');

// Получаем данные
$stmt = $pdo->query("SELECT * FROM resources ORDER BY priority DESC, id DESC");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    fputcsv($output, [
        $row['name'],
        $row['url'],
        $row['status'],
        $row['platform'],
        $row['category'],
        $row['type'],
        $row['subscribers'],
        $row['description'],
        $row['priority'],
        $row['price'],
        $row['pin_price']
    ], ';');
}

fclose($output);
exit;