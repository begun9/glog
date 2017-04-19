<?php

if (isset($_GET['regist'])){

	$name_user = $_POST['name_user_reg'];
	$surname = $_POST['surname_reg'];
	$login = $_POST['login_reg'];
	$password = $_POST['password_reg'];

	//проверяем наличие пользователя
	News::Add_User ($name_user, $surname, $login, $password);
	
		header('Location: ../index.php');

}

if (isset($_GET['del']))
{
	if ($_GET['delet'] == "new"){
		News::Del_New($_GET['del']);
	}
	if ($_GET['delet'] == "group"){
		News::Del_group($_GET['del']);
	}

	header('Location: ../index.php');
}

if (isset($_GET['upd_new']))
{
	if (isset($_POST['header']) || isset($_POST['body_news']))
	{
		News::upd_new($_GET['upd_new'], $_POST['header'], $_POST['body_news']);
		header('Location: ../index.php');
	}else{
		header("Location: ../template/temp3.php/?upd_new=".$_GET['upd_new']);
	}
	
}

if (isset($_GET['add_group'])){
	if (isset($_POST['name_group']))
	{
		echo $_POST['significance'];
		News::add_group($_POST['name_group'], $_POST['significance']);
		header('Location: ../index.php');
	}else
	{
		header('Location: ../template/temp4.php');
	}
}


if (isset($_GET['add_new']) && isset($_GET['user']))
{
	$header = $_POST['header'];
	$body_news = $_POST['body_news'];
	$add_new = $_GET['add_new'];
	$user = $_GET['user'];

	News::Add_New ($header, $body_news, $add_new, $user);
	header('Location: ../index.php');
} 



if (isset($_GET['des']))
{
	session_destroy();
	header('Location: ../index.php');
}

if (isset($_GET['user']))
{
	$name = $_GET['user'];
	News::User_News($name);
		
	
}elseif (isset($_GET['group'])) {
	$group = $_GET['group'];
	News::Group_News($group);
}elseif (isset($_GET['data'])) {
	$data = $_GET['data'];
	echo $_GET['data'];
	News::Data_News($data);
}else{
	News::SelectAll();
}

if (isset($_POST['login']) && isset($_POST['password'])) 
{
	$login = trim($_POST['login']);
	$password = trim($_POST['password']);
	News::aunt($login, $password);
	//проверяем результат запроса, если верно, присваиваем в сессию
	if (mysqli_num_rows(News::$aunt_rez) > 0){


		$_SESSION['login'] = $login;
		$_SESSION['password'] = $password;
		while ($row = mysqli_fetch_assoc(News::$aunt_rez))
	{
		$_SESSION['name'] = $row['name'];
		$_SESSION['surname'] = $row['surname'];
		$_SESSION['id_users'] = $row['id_users'];
		News::Update_data($row['login']);
	}}
}



?>