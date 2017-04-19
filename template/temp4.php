

<!doctype html>
<html lang="ru">
<head>
	<title>Новая группа</title>
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

<form method="POST" action="../../index.php/?add_group=2">
    <p>Введите название группы:</p>
    <p><input type="text" name="name_group" style="width: 400px;"></p>
    <p><select name="significance">
        <option>Обычная</option>
        <option>Средняя</option>
        <option>Важная</option>
        <option>Особая</option>
    </select></p>
    
    <p><input type="submit" name="bat" value="сохранить">
</form>
</body>
</html>