
<?php
session_start();
date_default_timezone_set("Asia/Krasnoyarsk");
require_once "db_connect.class.php";
News::Connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
include "controller.php";

// Обрабатывает ряд результата запроса и возвращает ассоциативный массив
if (isset(News::$result)){
include "template/temp1.php";	
};

// Закрываем соединение с базой данных
News::Close();

?>