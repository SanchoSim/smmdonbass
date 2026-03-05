<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $value = isset($_POST['show_reserve']) ? '1' : '0';

    $stmt = $pdo->prepare("
        UPDATE settings SET value = ?
        WHERE name = 'show_reserve'
    ");
    $stmt->execute([$value]);

    header("Location: dashboard.php");
    exit;
}

require 'partials/header.php';

function toggleOrder($currentSort, $column, $currentOrder) {
    if ($currentSort === $column) {
        return $currentOrder === 'asc' ? 'desc' : 'asc';
    }
    return 'asc';
}

$allowedSort = [
    'id',
    'name',
    'platform',
    'category',
    'type',
    'subscribers',
    'priority',
    'price',
    'pin_price'
];

$sort = $_GET['sort'] ?? 'priority';
$order = $_GET['order'] ?? 'desc';

if (!in_array($sort, $allowedSort)) {
    $sort = 'priority';
}

$order = strtolower($order) === 'asc' ? 'asc' : 'desc';

// $stmt = $pdo->query("
//     SELECT * FROM resources
//     ORDER BY priority DESC, id DESC
// ");

$stmt = $pdo->query("
    SELECT * FROM resources
    ORDER BY (status = 'reserve') ASC, $sort $order
");



$resources = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT value FROM settings WHERE name = 'show_reserve'");
$stmt->execute();
$showReserve = $stmt->fetchColumn();
?>



<div class="table-section">
      <span>  
    <a href="add.php" class="btn au-btn">Добавить</a>
    <a href="upload.php" class="btn au-btn">Загрузить</a>
    <a href="export.php" class="btn au-btn">Экспорт CSV</a>
    <form method="post" style="margin-bottom:20px; display: inline-block">

<label>
    <input type="checkbox" name="show_reserve" value="1"
        <?= $showReserve == '1' ? 'checked' : '' ?>>
    Показывать резервные пользователям
</label>

<button type="submit" class="btn btn-primary">Сохранить</button>

</form>
    
    <!-- <h2>Список ресурсов</h2> -->
</span>


<table class="resource-table">
<thead>
<tr>
<!-- <th class="col-id">ID</th> -->

<th class="col-name"> 
<a href="?sort=name&order=<?= toggleOrder($sort, 'name', $order) ?>">
    Название
        <?php if ($sort === 'name'): ?>
        <?= $order === 'asc' ? '▲' : '▼' ?>
        <?php endif; ?>
        </a>
</th>

<th class="col-platform">
    <a href="?sort=platform&order=<?= toggleOrder($sort, 'platform', $order) ?>">
    Платформа
        <?php if ($sort === 'platform'): ?>
        <?= $order === 'asc' ? '▲' : '▼' ?>
        <?php endif; ?>
        </a>
</th>

<th class="col-category">
    <a href="?sort=category&order=<?= toggleOrder($sort, 'category', $order) ?>">
    Категория
        <?php if ($sort === 'category'): ?>
        <?= $order === 'asc' ? '▲' : '▼' ?>
        <?php endif; ?>
        </a>
</th>

<th class="col-type">
<a href="?sort=type&order=<?= toggleOrder($sort, 'type', $order) ?>">
    Тип
        <?php if ($sort === 'type'): ?>
        <?= $order === 'asc' ? '▲' : '▼' ?>
        <?php endif; ?>
        </a>
</th>


<th class="col-subs">Подписчики</th>
<th class="col-price">
<a href="?sort=price&order=<?= toggleOrder($sort, 'price', $order) ?>">
    Цена
        <?php if ($sort === 'price'): ?>
        <?= $order === 'asc' ? '▲' : '▼' ?>
        <?php endif; ?>
        </a>
</th>


<th class="col-pin">Закреп</th>
<th class="col-priority">Приоритет</th>
<th class="col-actions">Действия</th>
</tr>
</thead>

<tbody>

<?php foreach ($resources as $r): ?>
<!-- <tr> -->
<?php if ($r['status'] === 'reserve'): ?>
<tr class="row-reserve-d">
<?php else: ?>
<tr>
<?php endif; ?>   

<!-- <td class="col-id"><?= e($r['id']) ?></td> -->

<td class="col-name">
<a href="<?= e($r['url']) ?>" target="_blank">
<?= e($r['name']) ?>
</a>
</td>

<td class="col-platform"><?= e($r['platform']) ?></td>
<td class="col-category"><?= e($r['category']) ?></td>

<td class="col-type">
<?php
if ($r['type'] === 'chat') {
    echo 'Чат / Группа';
}
if ($r['type'] === 'channel') {
    echo 'Канал';
}
?>
</td>

<td class="col-subs"><?= e($r['subscribers']) ?></td>
<td class="col-price"><?= e($r['price']) ?></td>
<td class="col-pin"><?= e($r['pin_price']) ?></td>
<td class="col-priority"><?= e($r['priority']) ?></td>

<td class="col-actions">
<a class="btn-edit" href="edit.php?id=<?= e($r['id']) ?>">✏</a>
<a class="btn-del" href="delete.php?id=<?= e($r['id']) ?>" 
onclick="return confirm('Удалить ресурс?')">🗑</a>
</td>

</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>

<?php require 'partials/footer.php'; ?>