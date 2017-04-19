<?php
    session_start();
    
    require_once "../db_connect.class.php";
    News::Connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    News::Select_new($_GET['upd_new']);
?>

<!doctype html>
<html lang="ru">
<head>
	<title>Редактирование новости</title>
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

<form method="POST" action="../../index.php/?upd_new=<?= $_GET['upd_new'] ?>">
    <p>Введите название новости:</p>
    <?php  while ($row = mysqli_fetch_assoc(News::$result)): ?>
    <p><input type="text" name="header" value="<?= $row['header'] ?>" style="width: 600px;"></p>
    <p>Введите текст новости:</p><p><textarea name="body_news" style="width: 600px;"><?= $row['body_news'] ?></textarea></p>
    <?php endwhile ?>
    <p><input type="submit" name="" value="сохранить">
</form>
</body>
</html>