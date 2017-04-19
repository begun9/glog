
<!doctype html>
<html lang="ru">

<head>

	<title>Новости</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../styles.css" />
</head>
<body class="index" link="black" vlink="black">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Dropdown
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>

<header class="mainH">
	<hgroup>
		<h1>Ново$ти</h1>
		</hgroup>
</header>

<div class="navigation">
<nav >
	<ul>
        <li><a href="../index.php">Главная</a></li>
        <li><a href="#">Админ</a></li>
        <li><a href="#">Контакты</a></li>
        <li><form method="get">Поиск новостей по дате:&nbsp<input type="date" name="data" placeholder="дд.мм.гггг" style="width: 120px;"><input type="submit" value="Поиск"></form></li>
    </ul>
</nav>
<div class="regist" style="text-align: center;" >
    <?php
        if (isset($_SESSION['login']) || isset($_SESSION['password']))
        {
            echo $_SESSION['name']."&nbsp".$_SESSION['surname']."&nbsp";
            echo "<a href='index.php/?des=d'>Выход</a>";
            echo "<p><a href='index.php/?add_group=1'>добавить группу</a></p>";
           

        }else{
            include "aunt/aunt.php";
        }

    ?>
        
</div>
</div>
<div style="float:left; width: 100px;">
       <?php
            News::Group_n();
            while ($row = mysqli_fetch_assoc(News::$group)) {
                
                echo "<a href='?group=".$row['id_group']."'>".$row['name_group']."</a>
                 ";
                 if (isset($_SESSION['login']) || isset($_SESSION['password']))
                 {
                    echo "<a title='Удалить группу' href='../index.php/?del=".$row['id_group']."&delet=group'><b>-</b></a>&nbsp&nbsp";
                    

                    echo "<a title='Добавить новость' href='template/temp2.php/?group=".$row['id_group']."'>+</a>";
                 }
                 echo "<br>";
            }

       ?>
       
    </div>


<div style="float:right;;">
   

    <div style="width: 700px;">
    <?php
        include "temp5.php";
           ?>
    
    <?php  while ($row = mysqli_fetch_assoc(News::$result)): ?>
     	
    <p><h2><?= $row['header']?>
        <?php
            if (isset($_SESSION['login']) || isset($_SESSION['password'])){
                if ($_SESSION['id_users'] == $row['id_users']){
                    echo "<h4><a href='index.php/?del=". $row['id_news']."&delet=new'>Удалить новость</a></h4>";
                     echo "<h4><a href='index.php/?upd_new=". $row['id_news']."'>Редактировать новость</a></h4>";
                }
            }
        ?>
    </h2></p>
    <div class='soob'>
    	<p><?= $row['body_news']?></p>
    	<p><?= $row['date']?></p>
        <p style="text-align: right;"><a href="?user= <?= $row['id_users'] ?>"><?= $row['name']?></a></p>
        <p style="text-align: right;"><a href="?group= <?= $row['id_group'] ?>"><?= $row['name_group']?></a></p>

    </div>
    <?php endwhile ?>
    </div>

    <div style=" float:right; width: 700px; height: 50px; text-align: center;">
        <?php 
            
         for ($i=1;$i<= News::$total_news;$i++)
            {
                echo "<div style='width: 10px; display: inline-block;'><a href='?page=". $i ."'>". $i. "</a></div>";
            }   
        ?>
    </div>
</div>
</body>
</html>
