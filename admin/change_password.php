<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Получаем текущего админа
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
    $stmt->execute([$_SESSION['admin']]);
    $admin = $stmt->fetch();

    if (!$admin) {
        $error = "Администратор не найден.";
    }

    elseif (!password_verify($old_password, $admin['password'])) {
        $error = "Старый пароль неверный.";
    }

    elseif (strlen($new_password) < 6) {
        $error = "Новый пароль должен быть минимум 6 символов.";
    }

    elseif ($new_password !== $confirm_password) {
        $error = "Пароли не совпадают.";
    }

    else {
        $hash = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE id = ?");
        $stmt->execute([$hash, $_SESSION['admin']]);

        $message = "Пароль успешно изменён.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Смена пароля</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="hero small">
<h1>Смена пароля</h1>
<a href="dashboard.php" class="btn">← Назад</a>
</header>

<section class="login-section">
<div class="login-card">

<h2>Изменить пароль</h2>

<?php if ($error): ?>
<div class="error-message"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php if ($message): ?>
<div class="status-main"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="post">

<div class="form-group">
<label>Старый пароль</label>
<input type="password" name="old_password" required>
</div>

<div class="form-group">
<label>Новый пароль</label>
<input type="password" name="new_password" required>
</div>

<div class="form-group">
<label>Повторите новый пароль</label>
<input type="password" name="confirm_password" required>
</div>

<button type="submit" class="btn btn-primary login-btn">
Сохранить
</button>

</form>

</div>
</section>

</body>
</html>