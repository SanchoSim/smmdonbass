<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$message = '';
$allowedStatus = ['main','reserve'];
$allowedPlatform = ['Telegram','VK','MAX'];
$allowedCategory = ['Новости','Авто/Мото','Поездки','Работа','Объявления','Недвижимость','Общение','Хобби','Услуги','Электроника'];
$allowedType = ['chat','channel'];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== 0) {
        $message = "Ошибка загрузки файла";
    } else {

        $fileTmp = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];

        // Проверка расширения
        if (pathinfo($fileName, PATHINFO_EXTENSION) !== 'csv') {
            $message = "Разрешены только .csv файлы";
        } else {

            $handle = fopen($fileTmp, 'r');

            if (!$handle) {
                $message = "Ошибка чтения файла";
            } else {

                $header = fgetcsv($handle, 0, ';');

                if (!$header || count($header) < 2) {
                    $message = "Файл должен содержать минимум 2 колонки: name;url";
                } else {

                    $added = 0;
                    $updated = 0;
                    // пропускаем первую строку
                   // fgetcsv($handle, 0, ';');

                    while (($row = fgetcsv($handle, 0, ';')) !== false) {

                        if (count($row) < 2) {
                            continue;
                        }

                        $name = trim($row[0]);
                        $url  = trim($row[1]);

                        if ($name === '' || $url === '') {
                            continue;
                        }

                        // Остальные поля (если есть)
                        $status = $row[2] ?? '';
                        if (!in_array($status, $allowedStatus)) {
                            $status = 'main';
                        }

                        $platform    = $row[3] ?? '';
                        if (!in_array($platform, $allowedPlatform)) {
                            $platform = 'Telegram';
                        }

                        $category    = $row[4] ?? 'Объявления';
                        if (!in_array($category, $allowedCategory)) {
                            $category = 'Объявления';
                        }

                        $type        = $row[5] ?? 'channel';
                        if (!in_array($type, $allowedType)) {
                            $type = 'channel';
                        }

                        $subscribers = isset($row[6]) && $row[6] !== '' ? (int)$row[6] : null;
                        $description = $row[7] ?? null;
                        $priority    = isset($row[8]) && $row[8] !== '' ? (int)$row[8] : 0;
                        $price       = isset($row[9]) && $row[9] !== '' ? (int)$row[9] : null;
                        $pin_price   = isset($row[10]) && $row[10] !== '' ? (int)$row[10] : null;

                        $stmt = $pdo->prepare("
                            INSERT INTO resources
                            (name, url, status, platform, category, type, subscribers, description, priority, price, pin_price)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE
                                name = VALUES(name),
                                status = values(status),
                                platform = VALUES(platform),
                                category = VALUES(category),
                                type = VALUES(type),
                                subscribers = VALUES(subscribers),
                                description = VALUES(description),
                                priority = VALUES(priority),
                                price = VALUES(price),
                                pin_price = VALUES(pin_price)
                        ");

                        $stmt->execute([
                            $name,
                            $url,
                            $status,
                            $platform,
                            $category,
                            $type,
                            $subscribers,
                            $description,
                            $priority,
                            $price,
                            $pin_price
                        ]);

                        if ($stmt->rowCount() == 1) {
                            $added++;
                        } elseif ($stmt->rowCount() == 2) {
                            $updated++;
                        }
                    }

                    fclose($handle);

                    $message = "Импорт завершён. Добавлено: $added. Обновлено: $updated.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Загрузка ресурсов</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="hero small">
<h1>Импорт ресурсов</h1>
<a href="dashboard.php" class="btn">← Назад</a>
</header>

<section class="login-section">
<div class="login-card">

<h2>Загрузить TXT файл</h2>

<?php if ($message): ?>
<div class="error-message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
<input type="file" name="file" accept=".csv" required>
<br><br>
<button type="submit" class="btn login-btn">Импортировать</button>
</form>

</div>
</section>

</body>
</html>