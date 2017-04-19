
<!doctype html>
<html lang="ru">
<head>
	<title>Моя первая страница</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../styles.css" />
</head>
<body class="index" link="black" vlink="black">

<header class="mainH">
	<hgroup>
		<h1>Ново$ти</h1>
			</hgroup>
</header>
<div class="navigation">
<nav >
	<ul>
        <li><a href="../index.php">Главная</a></li>
        <li><a href="admin/index.php">Админ</a></li>
        <li><a href="#">Контакты</a></li>
        <li><a href="#">Архивы новостей</a></li>
    </ul>
</nav>
</div>
    <div>
    
    <?php  while ($row = mysqli_fetch_assoc(DataBase::$result)): ?>
     	
    <p><h2><?= $row['header']?></h2></p>
    <div class='soob'>
    	<p><?= $row['body_news']?></p>
    	<p><?= $row['date']?></p>
    </div>
    <?php endwhile ?>
    </div>

    <div>
        <?php 
            
         for ($i=1;$i<= DataBase::$total_news;$i++)
            {
                echo "<div style='width: 10px; display: inline-block;'><a href='?page=". $i ."'>". $i. "</a></div>";
            }   
        ?>
    </div>
</body>
</html>
