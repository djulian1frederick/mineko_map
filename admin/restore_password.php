<?php 

	require_once('connection.php');
	$email = $_POST['email'];

	$sql = "SELECT user_email, activation, user_login from users where user_email='".$email."'";
	$query = mysqli_query($bd, $sql);
	$row = mysqli_fetch_array($query);
	if($row <> NULL && $row['activation'] == 1) {
		$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
		$root_dir = $url;
		$activation = password_hash($row['user_login'], PASSWORD_DEFAULT);
		// отправка письма
		// Формирование самого письма
		$title = "Сброс пароля учетной записи";
		$body = "<h2>Уважаемый пользователь!</h2>
		<b>Для того, чтобы сбросить пароль вашей учетной записи на портале 'Экспортного каталога Оренбургской области' необходимо перейти по следующей ссылке:</b><br>
		<b><a href='".$root_dir."/restore_password?i=".$activation."&e=".$email."'>".$root_dir."/restore_password</a><br><br><br>
		<b>Если вы проигнорируете это сообщение, ваш пароль не будет изменен. Если вы не запрашивали сброс пароля, сообщите нам.</b><br><br><br><br><br>";
		include("../email-activate/send.php");

	}
	elseif ($row <> NULL && $row['activation'] == 0) {
		echo '<span>Ваша учетная запись еще не активирована. Проверьте почту для активации учетной записи, чтобы сбросить пароль.</span>';
	}
	else {
		echo '<span>Для введенного Вами адреса электронной почты учетной записи не найдено</span>';
	}

?>