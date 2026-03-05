<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM resources WHERE id = ?");
$stmt->execute([$id]);
$resource = $stmt->fetch();

if (!$resource) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("
        UPDATE resources SET
            name = ?,
            url = ?,
            status = ?,
            platform = ?,
            category = ?,
            type = ?,
            subscribers = ?,
            description = ?,
            priority = ?,
            price = ?,
            pin_price = ?
        WHERE id = ?
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
        $_POST['pin_price'] ?: null,
        $id
    ]);

    header("Location: dashboard.php");
    exit;
}

require 'partials/header.php';
?>

<div class="form-wrapper">

<h2>Редактировать ресурс</h2>

<form method="post" class="resource-form">

<div class="form-grid">

<div class="form-block">
<h3>Основная информация</h3>

<label>Название</label>
<input name="name" value="<?= e($resource['name']) ?>" required>

<label>URL</label>
<input name="url" value="<?= e($resource['url']) ?>" required>

<label>Описание</label>
<textarea name="description" rows="4"><?= e($resource['description']) ?></textarea>
</div>

<div class="form-block">
<h3>Параметры</h3>

<label>Платформа</label>
<select name="platform" required>
<?php
$platforms = ['Telegram','VK','MAX'];
foreach ($platforms as $p) {

    if ($resource['platform'] === $p) {
        echo '<option value="' . e($p) . '" selected>' . e($p) . '</option>';
    } else {
        echo '<option value="' . e($p) . '">' . e($p) . '</option>';
    }
}
?>
</select>

<label>Категория</label>
<select name="category" required>
<?php
$categories = [
'Новости','Авто/Мото','Поездки','Работа',
'Объявления','Недвижимость','Общение',
'Хобби','Услуги','Электроника'
];

foreach ($categories as $c) {

    if ($resource['category'] === $c) {
        echo '<option value="' . e($c) . '" selected>' . e($c) . '</option>';
    } else {
        echo '<option value="' . e($c) . '">' . e($c) . '</option>';
    }
}
?>
</select>

<label>Тип</label>
<select name="type" required>
<?php
$types = ['chat' => 'Чат / Группа', 'channel' => 'Канал'];

foreach ($types as $value => $label) {

    if ($resource['type'] === $value) {
        echo '<option value="' . e($value) . '" selected>' . e($label) . '</option>';
    } else {
        echo '<option value="' . e($value) . '">' . e($label) . '</option>';
    }
}
?>
</select>

<label>Статус</label>
<select name="status">

<option value="">—</option>

<?php
$statuses = ['main' => 'Основной', 'reserve' => 'Резерв'];

foreach ($statuses as $value => $label) {

    if ($resource['status'] === $value) {
        echo '<option value="' . e($value) . '" selected>' . e($label) . '</option>';
    } else {
        echo '<option value="' . e($value) . '">' . e($label) . '</option>';
    }
}
?>
</select>

</div>

<div class="form-block">
<h3>Статистика</h3>

<label>Подписчики</label>
<input type="number" name="subscribers" value="<?= e($resource['subscribers']) ?>">

<label>Стоимость размещения (₽)</label>
<input type="number" name="price" value="<?= e($resource['price']) ?>">

<label>Стоимость закрепа (₽)</label>
<input type="number" name="pin_price" value="<?= e($resource['pin_price']) ?>">

<label>Приоритет</label>
<input type="number" name="priority" value="<?= e($resource['priority']) ?>">
</div>

</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary">Сохранить изменения</button>
</div>

</form>
</div>

<?php require 'partials/footer.php'; ?>