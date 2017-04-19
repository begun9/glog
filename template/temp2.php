<?php
    session_start();
?>

<!doctype html>
<html lang="ru">
<head>
	<title>Новая новость</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../styles.css" />
</head>
<body class="index" link="black" vlink="black">
<div class="navigation">
<nav >
    <ul>
        <li><a href="../../index.php">Главная</a></li>
        <li><a href="../admin/index.php">Админ</a></li>
        <li><a href="#">Контакты</a></li>
            </ul>
</nav>
</div>

<form method="POST" action="../../index.php/?add_new=<?= $_GET['group'] ?>&user=<?= $_SESSION['id_users'] ?>">
    <p>Введите название новости:</p>
    <p><input type="text" name="header" style="width: 600px;"></p>
    <p>Введите текст новости:</p><p><textarea name="body_news" style="width: 600px;"></textarea></p>
    <p><input type="submit" name="" value="сохранить">
</form>
</body>
</html>
