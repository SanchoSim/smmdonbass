<?php
session_start();
$isAdmin = isset($_SESSION['admin']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SMM Donbass – Продвижение в Telegram</title>
<!-- <link rel="stylesheet" href="css/style.css"> -->
 <!-- автообновление свежего css -->
<link rel="stylesheet" href="css/style.css?v=<?= filemtime('css/style.css') ?>">
</head>
<body>

<header class="hero">
<h1>SMM Donbass</h1>
<p>Региональное продвижение в мессенджерах: реклама в чатах и каналах Донбасса</p>

<?php if ($isAdmin): ?>
    <a href="/admin/dashboard.php" class="btn admin-btn">Админ-панель</a>
<?php else: ?>
    <a href="/admin/login.php" class="btn admin-btn">Вход для администратора</a>
<?php endif; ?>

<div class="buttons">
<a href="more.html" class="btn">Узнать больше</a>
<a href="#payment" class="btn red">Оплата</a>
<a href="resources.php" class="btn">Наши ресурсы</a>
</div>
</header>

<section class="services">
<h2>Наши услуги</h2>

<div class="cards">
<div class="card">
<h3>Реклама в чатах</h3>
<p>Таргетированное размещение постов и объявлений в региональных чатах c активной аудиторией.</p>
</div>

<div class="card">
<h3>Продвижение в каналах</h3>
<p>Реклама и интеграции в популярных региональных каналах для увеличения охвата.</p>
</div>

<div class="card">
<h3>SMM сопровождение</h3>
<p>Консультации по ведение каналов в Telegram и Max: контент, стратегия и аналитика.</p>
</div>
</div>
</section>

<section class="about">
<h2>Почему именно мы?</h2>
<p>Мы специализируемся на продвижении в Донбасском регионе. Наша команда знает локальную аудиторию и умеет настраивать рекламу так, чтобы она приносила результат. Собственная сеть ресурсов и прямое взаимодействие с владельцами чатов и каналов позволяет нам предлагать лучшие условия для наших клиентов.</p>
</section>

<section class="contact">
<h2>Связаться с нами</h2>
<p>Напишите нам в Telegram, чтобы обсудить детали сотрудничества.
</p>
<a href="https://t.me/luganskGroup_bot" class="btn">Написать в Telegram</a>
</section>

<section id="payment" class="payment">
<h2>Оплата</h2>
<p>Мы принимаем оплату удобным для вас способом. По кнопке ниже Вы перейдете на форму оплаты.
</p>
<a href="https://yookassa.ru/my/i/aL17UU8VmrIF/l" class="btn red">Оплатить</a>
</section>

<footer>
<p>© 2025 SMM Donbass. Все права защищены.</p>
</footer>

</body>
</html>