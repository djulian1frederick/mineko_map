<?php 
	session_start();

	$email = $_SESSION['this_email'];
	$password_frst = $_POST['password_once'];
	$password_repeat = $_POST['password_repeat'];
	$today =date("d.m.Y");
	require_once('admin/connection.php');
	if($password_frst == $password_repeat) {
		$truepassword = password_hash($password_repeat, PASSWORD_DEFAULT);
		$sql_update = mysqli_query($bd, "UPDATE users set password='".$truepassword."' where user_email='".$email."'");
		if($sql_update) {
			$msg = "Вы успешно изменили пароль.";
			if(!isset($_SESSION['user_id']))
			{$msg .= '<br>Нажмите <a href="login">сюда</a> для перехода к авторизации';}
			$title = "Сброс пароля учетной записи";
			$body = "<div style='font-family: Circe;'><h2>Уважаемый пользователь!</h2>
			<b>Вами был изменен пароль вашей учетной записи на портале 'Экспортного каталога Оренбургской области' ".$today."<br> Если это были не Вы, сообщите нам.</b><br><br><br><br><br></div>";
			include("email-activate/send.php");
		}
	}
	else {
		$msg = "Введенные вами пароли не совпадают, попробуйте снова.";
	}
	echo '<span>'.$msg.'</span>';

?>