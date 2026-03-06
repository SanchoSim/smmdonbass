<?php
require_once 'config.php';
$stmt = $pdo->prepare("SELECT value FROM settings WHERE name = 'show_reserve'");
$stmt->execute();
$showReserve = $stmt->fetchColumn();



$where = [];
if ($showReserve != '1') {
    $where[] = "(status IS NULL OR status != 'reserve')";
}
$params = [];

$view = $_GET['view'] ?? 'cards';

if (!in_array($view, ['cards','table'])) {
    $view = 'cards';
}



/* ===== ФИЛЬТРЫ ===== */

if (!empty($_GET['category'])) {
    $where[] = "category = ?";
    $params[] = $_GET['category'];
}

if (!empty($_GET['platform'])) {
    $where[] = "platform = ?";
    $params[] = $_GET['platform'];
}

if (!empty($_GET['type'])) {
    $where[] = "type = ?";
    $params[] = $_GET['type'];
}

$sql = "SELECT * FROM resources";

if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

/* ===== СОРТИРОВКА ===== */

$allowedSort = [
    'name',
    'platform',
    'category',
    'type',
    'subscribers',
    'price',
    'pin_price',
    'priority'
];

$sort = $_GET['sort'] ?? 'priority';
$dir  = $_GET['dir'] ?? 'desc';

if (!in_array($sort, $allowedSort)) {
    $sort = 'priority';
}

if (!in_array($dir, ['asc','desc'])) {
    $dir = 'desc';
}

$sql .= " ORDER BY (status = 'reserve') ASC, $sort $dir";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$resources = $stmt->fetchAll();


function sortLink($column, $label, $currentSort, $currentDir, $view) {

    $dir = 'asc';

    if ($currentSort === $column && $currentDir === 'asc') {
        $dir = 'desc';
    }

    $query = $_GET;
    $query['sort'] = $column;
    $query['dir'] = $dir;
    $query['view'] = $view;   // 🔥 ВАЖНО

    $arrow = '';

    if ($currentSort === $column) {
        $arrow = $currentDir === 'asc' ? ' ▲' : ' ▼';
    }

    return '<a href="?' . http_build_query($query) . '">' . $label . $arrow . '</a>';
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ресурсы SMM Donbass</title>
<!-- <link rel="stylesheet" href="css/style.css"> -->
<link rel="stylesheet" href="css/style.css?v=<?= filemtime('css/style.css') ?>">
</head>
<body>

<header class="hero small">
<h1>Рекламируемые ресурсы</h1>
<div>
    <div>
<a href="index.php" class="btn">← На главную</a></div>
<div class="view-switch">

<a href="?<?= http_build_query(array_merge($_GET, ['view' => 'cards'])) ?>"
class="view-btn <?= $view === 'cards' ? 'active' : '' ?>">
Карточки
</a>

<a href="?<?= http_build_query(array_merge($_GET, ['view' => 'table'])) ?>"
class="view-btn <?= $view === 'table' ? 'active' : '' ?>">
Таблица
</a>
</div>
</div>

</header>

<section class="table-section">

<form method="get" class="filter-form">

<input type="hidden" name="view" value="<?= e($view) ?>">

<select name="category">
<option value="">Все категории</option>
<?php
$cats = ['Новости','Авто/Мото','Поездки','Работа','Объявления','Недвижимость','Общение','Хобби','Услуги','Электроника'];
foreach ($cats as $c) {
    $selected = ($_GET['category'] ?? '') === $c ? 'selected' : '';
    echo "<option value=\"$c\" $selected>$c</option>";
}
?>
</select>

<select name="platform">
<option value="">Все платформы</option>
<?php
$platforms = ['Telegram','VK','MAX'];
foreach ($platforms as $p) {
    $selected = ($_GET['platform'] ?? '') === $p ? 'selected' : '';
    echo "<option value=\"$p\" $selected>$p</option>";
}
?>


</select>

<select name="type">
<option value="">Все типы</option>
<?php
$types = ['channel'=>'Канал','chat'=>'Чат / Группа'];
foreach ($types as $v=>$s) {
    $selected = ($_GET['type'] ?? '') === $v ? 'selected' : '';
    echo "<option value=\"$v\" $selected>$s</option>";
}
?>

<!-- <option value="channel">Канал</option>
<option value="chat">Чат / Группа</option> -->
</select>

<?php if ($view === 'cards'): ?>
       <!-- селект сортировки -->

<select name="sort">
<option value="">Сортировка</option>
<option value="priority">По приоритету</option>
<option value="subscribers">По подписчикам</option>
<option value="price">По цене</option>
<option value="pin_price">По цене закрепа</option>
</select>
<?php endif; ?>

<button type="submit" class="btn btn-primary">Применить</button>

</form>
<?php if ($view === 'cards'): ?>
    <!-- тут твой блок resource-grid -->
<div class="resource-grid">

<?php foreach ($resources as $r): ?>

<?php
$cardClass = '';

if ($r['status'] === 'reserve') {
    $cardClass = 'card-reserve';
}
?>

<div class="resource-card <?= $cardClass ?>">

<div class="card-header">
    <a href="<?= e($r['url']) ?>" target="_blank" class="card-title">
        <?= e($r['name']) ?>
    </a>
</div>

<div class="card-badges">
    <span class="badge platform"><?= e($r['platform']) ?></span>
    <span class="badge category"><?= e($r['category']) ?></span>
    <span class="badge type">
        <?= $r['type'] === 'channel' ? 'Канал' : 'Чат' ?>
    </span>
</div>

<?php if ($r['description']): ?>
<div class="card-description">
    <?= e($r['description']) ?>
</div>
<?php endif; ?>

<div class="card-stats">

<?php if ($r['subscribers']): ?>
<div class="stat">
    <span class="label">Подписчики</span>
    <span class="value">
        <?= number_format($r['subscribers'],0,' ',' ') ?>
    </span>
</div>
<?php endif; ?>

<?php if ($r['price']): ?>
<div class="stat">
    <span class="label">Пост</span>
    <span class="value">
        <?= number_format($r['price'],0,' ',' ') ?> ₽
    </span>
</div>
<?php endif; ?>

<?php if ($r['pin_price']): ?>
<div class="stat">
    <span class="label">Закреп</span>
    <span class="value">
        <?= number_format($r['pin_price'],0,' ',' ') ?> ₽
    </span>
</div>
<?php endif; ?>

</div>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

    <!-- тут таблица -->

    <div class="table-wrapper">

<table class="public-table">

<thead>
<tr>
  

    <!-- <th>ID</th> -->
<th><?= sortLink('name','Название',$sort,$dir,$view) ?></th>
<th><?= sortLink('platform','Платформа',$sort,$dir,$view) ?></th>
<th><?= sortLink('category','Категория',$sort,$dir,$view) ?></th>
<th><?= sortLink('type','Тип',$sort,$dir,$view) ?></th>
<!-- <th><?= sortLink('subscribers','Подписчики',$sort,$dir,$view) ?></th> -->
<th><?= sortLink('price','Цена',$sort,$dir,$view) ?></th>
<th><?= sortLink('pin_price','Закреп',$sort,$dir,$view) ?></th>

</tr>
</thead>

<tbody>

<?php foreach ($resources as $r): ?>

<?php if ($r['status'] === 'reserve'): ?>
<tr class="row-reserve">
<?php else: ?>
<tr>
<?php endif; ?>
    <!-- <td><?= e($r['id']) ?></td> -->

    <td class="name-cell">
        <a href="<?= e($r['url']) ?>" target="_blank">
            <?= e($r['name']) ?>
        </a>
        <?php if ($r['description']): ?>
            <div class="desc"><?= e($r['description']) ?></div>
        <?php endif; ?>
    </td>

    <td><?= e($r['platform']) ?></td>

    <td><?= e($r['category']) ?></td>

    <td><?= $r['type'] === 'channel' ? 'Канал' : 'Чат' ?></td>

    <!-- <td class="num">
        <?= $r['subscribers'] ? number_format($r['subscribers'],0,' ',' ') : '—' ?>
    </td> -->

    <td class="num">
        <?= $r['price'] ? number_format($r['price'],0,' ',' ') . ' ₽' : '—' ?>
    </td>

    <td class="num">
        <?= $r['pin_price'] ? number_format($r['pin_price'],0,' ',' ') . ' ₽' : '—' ?>
    </td>

</tr>

<?php endforeach; ?>

</tbody>
</table>

</div>



<?php endif; ?>



</div>
</section>

</body>
</html>