<!doctype html>
<html lang="ru">
<head>
    <title>Новости</title>
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
<div style="display: inline-block;">
    <div style="float:left;  width: 100px;">
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

    <div style=" float:right; width: 800px;">
    
    
    <div class='soob'>
    <?php
    
      echo "<table>";
      $sliced = array_slice(News::$result, 1);
foreach($sliced as $key => $value) { 
    echo "<tr><td>";     
            if (isset($_SESSION['login']) || isset($_SESSION['password']))
                 {
                    echo "<a title='Удалить группу' href='../index.php/?del=".$value['id_group']."&delet=group'><b>-</b></a>&nbsp";
                }
    echo "<a href='?group=".$value['id_group']."'>".$value['name_group']."</a></td><td>".$value['date']."</td>
    <td>".$value['login']."</td><td>".$value['header']."</td></tr>";
}
echo "</table>";
?>
    </div>
    
    </div>

    <div style=" float:right; width: 800px; height: 50px; text-align: center;">
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
