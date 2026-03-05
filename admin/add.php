<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("
        INSERT INTO resources 
        (name, url, status, platform, category, type, subscribers, description, priority, price)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $_POST['name'],
        $_POST['url'],
        $_POST['status'] ?: null,
        $_POST['platform'],
        $_POST['category'],
        $_POST['type'],
        $_POST['subscribers'] ?: null,
        $_POST['description'] ?: null,
        $_POST['priority'] ?: 0,
        $_POST['price'] ?: null,
        $_POST['pin_price'] ?: null
    ]);

    header("Location: dashboard.php");
    exit;
}

require 'partials/header.php';
?>



<div class="form-wrapper">
    <h2>Добавить ресурс</h2>

<form method="post" class="resource-form">

<div class="form-grid">

<div class="form-block">
<h3>Основная информация</h3>

<label>Название</label>
<input name="name" required>

<label>URL</label>
<input name="url" required>

<label>Описание</label>
<textarea name="description" rows="4"></textarea>
</div>

<div class="form-block">
<h3>Параметры</h3>

<label>Платформа</label>
<select name="platform" required>
    <option value="Telegram">Telegram</option>
    <option value="VK">VK</option>
    <option value="MAX">MAX</option>
</select>

<label>Категория</label>
<select name="category" required>
    <option value="Новости">Новости</option>
    <option value="Авто/Мото">Авто/Мото</option>
    <option value="Поездки">Поездки</option>
    <option value="Работа">Работа</option>
    <option value="Объявления">Объявления</option>
    <option value="Недвижимость">Недвижимость</option>
    <option value="Общение">Общение</option>
    <option value="Хобби">Хобби</option>
    <option value="Услуги">Услуги</option>
    <option value="Электроника">Электроника</option>
</select>

<label>Тип</label>
<select name="type" required>
    <option value="chat">Чат / Группа</option>
    <option value="channel">Канал</option>
</select>

<label>Статус</label>
<select name="status">
    <option value="">—</option>
    <option value="main">Основной</option>
    <option value="reserve">Резерв</option>
</select>
</div>

<div class="form-block">
<h3>Статистика</h3>

<label>Подписчики</label>
<input type="number" name="subscribers">

<label>Стоимость размещения (₽)</label>
<input type="number" name="price">

<label>Стоимость закрепа (₽)</label>
<input type="number" name="pin_price">

<label>Приоритет</label>
<input type="number" name="priority" value="0">
</div>

</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary">
Сохранить
</button>
</div>

</form>
</div>

<?php require 'partials/footer.php'; ?>