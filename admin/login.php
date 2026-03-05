<?php
session_start();
require_once '../config.php';

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE login = ?");
    $stmt->execute([$_POST['login']]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($_POST['password'], $admin['password'])) {
        $_SESSION['admin'] = $admin['id'];
        header("Location: dashboard.php");
        exit;
    }

    $error = "Неверный логин или пароль";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Вход в админку – SMM Donbass</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header class="hero small">
    <h1>Вход в админ-панель</h1>
    <a href="../index.php" class="btn">← На главную</a>
</header>

<section class="login-section">

<div class="login-card">

<h2>Авторизация</h2>

<?php if (!empty($error)): ?>
    <div class="error-message"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">

    <div class="form-group">
        <label>Логин</label>
        <input name="login" required>
    </div>

    <div class="form-group">
        <label>Пароль</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit" class="btn login-btn">Войти</button>

</form>

</div>
</section>

<footer>
<p>© 2025 SMM Donbass. Все права защищены.</p>
</footer>

</body>
</html>