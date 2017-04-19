<?php
include "connect.php";
	/**
	создание соединения с бд
	*/
	class News
	{

		public static $bConnect;
		public static $bSelectDB;
		public static $result;
		public static $resultF;
		public static $total_news;
		public static $aunt_rez;
		public static $regist;
		public static $group;




		public static function Connect ($host, $user, $pass, $name) {

			self::$bConnect = mysqli_connect($host, $user, $pass);

			if(!self::$bConnect)
			{
				echo "<p><b>Соединение с базой данных не установлено</b></p>";
				exit();
				return false;
			}


			self::$bSelectDB = mysqli_select_db(self::$bConnect, $name);

			if (!self::$bSelectDB)
			{
				echo "<p><b>".mysql_error()."</b></p>";
				exit();
				return false;
			}

			$query = "SET NAMES 'utf8'";
			if (mysqli_query(self::$bConnect,$query) !== true)
			{
				echo "Не удалось изменить кодировку";
			}
			
			return self::$bSelectDB;
		}

		//Выводим все новости
		public static function SelectAll ()
		{
			$num = 4; //колличество выводимых строк
			if (!isset($_GET['page'])){
				$_GET['page']=1;
			}
			$page = $_GET['page'];
			$result00 = mysqli_query(self::$bConnect,"SELECT COUNT(*) FROM `news`");
			$temp = mysqli_fetch_array($result00);
			$posts = $temp[0];
			$total = (($posts - 1) / $num) + 1;
			$total =  intval($total);
			$page = intval($page);
			if(empty($page) or $page < 0) $page = 1;
			if($page > $total) $page = $total;
			$start = $page * $num - $num;

			self::$result = mysqli_query(self::$bConnect,  "SELECT news.id_news, news.header,news.body_news ,users.name, news.date, newsgroups.name_group, news.id_group, news.id_users FROM news left JOIN users ON (news.id_users = users.id_users) left JOIN newsgroups ON (news.id_group = newsgroups.id_group) ORDER BY news.id_news DESC LIMIT $start, $num");
			self::$total_news = $total;
			
			return self::$result;
		}


		//вывод всех новостей пользователя
		public static function User_News ($name)
		{
			self::$result = mysqli_query(self::$bConnect,  "SELECT news.id_news, news.header,news.body_news ,users.name, news.date, newsgroups.name_group, news.id_group, news.id_users FROM news left JOIN users ON (news.id_users = users.id_users) left JOIN newsgroups ON (news.id_group = newsgroups.id_group) where news.id_users=$name ORDER BY news.id_news");
			
			
			return self::$result;
		}

			//вывод группы
		public static function Group_News ($group)
		{
			self::$result = mysqli_query(self::$bConnect,  "SELECT news.id_news, news.header,news.body_news ,users.name, news.date, newsgroups.name_group, news.id_group, news.id_users FROM news left JOIN users ON (news.id_users = users.id_users) left JOIN newsgroups ON (news.id_group = newsgroups.id_group) where news.id_group=$group ORDER BY news.id_news DESC");
			
			
			return self::$result;
		}

		//выборка новости по дате
		public static function Data_News ($data)
		{


			self::$result = mysqli_query(self::$bConnect,  "SELECT news.id_news, news.header,news.body_news ,users.name, news.date, newsgroups.name_group, news.id_group, news.id_users FROM news left JOIN users ON (news.id_users = users.id_users) left JOIN newsgroups ON (news.id_group = newsgroups.id_group) where news.date='$data'");
			
			
			return self::$result;
		}

		//Регистрация нового пользователя
		public static function Add_User ($name_user, $surname, $login, $password)
		{
			$result = mysqli_query(self::$bConnect, "SELECT * FROM `users` where login = '$login'");
			if (!mysqli_num_rows($result)){
			$query = sprintf("INSERT INTO `users` (name, surname, login, password) VALUES ('%s', '%s', '%s', '%s')", mysqli_real_escape_string(self::$bConnect, $name_user),
				mysqli_real_escape_string(self::$bConnect, $surname),
				mysqli_real_escape_string(self::$bConnect, $login),
				mysqli_real_escape_string(self::$bConnect, $password)
				);
			self::$regist = mysqli_query(self::$bConnect, $query);

			if (!self::$regist){
				die(mysql_error(self::$bConnect));			
						return false;
			}else{
				return true;
			}

		}}

		//проверка 
		public static function aunt ($login, $pass)
		{
			self::$aunt_rez = mysqli_query(self::$bConnect, "SELECT * FROM `users` WHERE login = '$login' and password = '$pass'");
			
			
			return self::$aunt_rez;
		}

		//Дата посещения

		public static function Update_data ($login)
		{
			$data = date("Y-m-d");
			$aunt_rez = mysqli_query(self::$bConnect, "UPDATE `users` SET date = '$data' WHERE login = '$login'");
			
			
			return true;
		}

		//добавить новость
		public static function Add_data ($header, $body_news, $id_group, $id_users)
		{
			$data = date("Y-m-d");

			$aunt_rez = mysqli_query(self::$bConnect, sprintf("INSERT INTO `news` (header, body_news, id_group, id_users, date) VALUES (%s, %s, '$id_group', '$id_users')"),
				mysqli_real_escape_string(self::$bConnect, $header),
				mysqli_real_escape_string(self::$bConnect, $body_news));
			
			
			return true;
		}
		//вывод групп
		public static function Group_n ()
		{
			self::$group = mysqli_query(self::$bConnect, "SELECT * FROM `newsgroups`");
			return self::$group;
		}
		//добавить новость
		public static function Add_New ($header, $body_news, $add_new, $user)
		{
			
			$data = date("Y-m-d H:i:s");
			$query = sprintf("INSERT INTO `news` (`header`, `body_news`, `date`, `id_group`, `id_users`) VALUES ('%s', '%s', '$data', $add_new, $user)", mysqli_real_escape_string(self::$bConnect, $header),
				mysqli_real_escape_string(self::$bConnect, $body_news)
				);
			self::$result = mysqli_query(self::$bConnect, $query);

			if (!self::$result){
				die(mysql_error(self::$bConnect));			
			return false;
			}else{
				return true;
			
			}
		}
		//удалить новость
		public static function Del_New($id_new)
		{
			self::$result = mysqli_query(self::$bConnect, "DELETE FROM `news` WHERE `news`.`id_news` = '$id_new'");
			if (!self::$result){
				die(mysql_error(self::$bConnect));
				return false;
			}else{
				return true;
			}
		}
		//удалить группу
		public static function Del_group($id_group)
		{
			self::$result = mysqli_query(self::$bConnect, "DELETE FROM `newsgroups` WHERE `newsgroups`.`id_group` = '$id_group'");
			if (!self::$result){
				die(mysql_error(self::$bConnect));
				return false;
			}else{
				return true;
			}
		}

		public static function Select_new ($id_new)
		{
			self::$result = mysqli_query(self::$bConnect, "SELECT *  FROM `news` WHERE `news`.`id_news` = '$id_new'");
			
			if (!self::$result){
				die(mysql_error(self::$bConnect));
				return false;
			}else{
				return self::$result;
			}
		}
		//редактировать новость
		public static function upd_new ($id_new, $header, $body_news)
		{
			$query = sprintf( "UPDATE `news` SET `header` = '%s', `body_news` = '%s' WHERE `id_news` = '$id_new'", mysqli_real_escape_string(self::$bConnect, $header),
				mysqli_real_escape_string(self::$bConnect, $body_news));

			$aunt_rez = mysqli_query(self::$bConnect, $query);
		}
		//добавление группы
		public static function add_group ($name_group, $significance)
		{
			
			$query = sprintf("INSERT INTO `newsgroups` (`name_group`, `significance`) VALUES ('%s', '$significance')", mysqli_real_escape_string(self::$bConnect, $name_group)
				);
			self::$result = mysqli_query(self::$bConnect, $query);

			if (!self::$result){
				die(mysqli_error(self::$bConnect));			
			return false;
			}else{
				return true;
			
			}
		}
		
		public static function select_v ()
		{
			self::$resultF = array();
			$result00 = mysqli_query(self::$bConnect,"SELECT COUNT(*) FROM `newsgroups`");
			$row = mysqli_fetch_assoc($result00); 
			for ($i=0; $i<=$row['COUNT(*)']; $i++)
			{
				$query =mysqli_query(self::$bConnect, " SELECT news.id_news, news.header,news.body_news ,users.login, news.date, newsgroups.name_group, news.id_group, news.id_users FROM `news` left JOIN users ON (news.id_users = users.id_users) left JOIN newsgroups ON (news.id_group = newsgroups.id_group)   WHERE news.id_group = '$i' GROUP BY news.date, news.id_group ORDER BY news.date DESC limit 1");

				self::$resultF[$i] =  mysqli_fetch_assoc($query);
			
			}
			

			return self::$resultF;
		}



		public static function Close()
		{
			return mysqli_close(self::$bConnect);
		}
		
		
	}
?>