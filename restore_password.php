<?php session_start();?>
<?php 

	require_once('admin/connection.php');
	$email = $_POST['email'];

	$sql = "SELECT user_email, activation, user_login from users where user_email='".$email."'";
	$query = mysqli_query($bd, $sql);
	$row = mysqli_fetch_array($query);
	if($row <> NULL && $row['activation'] == 1) {
		$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
		$root_dir = $url;
		$activation_u =$row['user_login'];
		$activation_u .=date("dmY");
		$activation = password_hash($activation_u, PASSWORD_DEFAULT);
		
		// отправка письма
		// Формирование самого письма
		$title = "Сброс пароля учетной записи";
		$body = "<div style='font-family: Circe;'><h2>Уважаемый пользователь!</h2>
		<b>Для того, чтобы сбросить пароль вашей учетной записи на портале 'Экспортного каталога Оренбургской области' необходимо перейти по следующей ссылке:</b><br>
		<b><a href='".$root_dir."/check_restore?i=".$activation."&e=".$email."'>".$root_dir."/restore_password</a><br>
		<b>Данная ссылка действует сутки.</b><br><br>
		<b>Если вы проигнорируете это сообщение, ваш пароль не будет изменен. Если вы не запрашивали сброс пароля, сообщите нам.</b><br><br><br><br><br></div>";
		include("/email-activate/send.php");
		if($result == "success") {echo '<span style="color: #753b3b;margin: 1.5% auto;border-bottom: #df1919 1px solid;">Инструкция по дальнейшим действиям отправлена на указанный адрес</span>';} 

	}
	elseif ($row <> NULL && $row['activation'] == 0) {
		echo '<span style="color: #753b3b;margin: 1.5% auto;border-bottom: #df1919 1px solid;">Ваша учетная запись еще не активирована. Проверьте почту для активации учетной записи, чтобы сбросить пароль.</span>';
	}
	else {
		echo '<span style="color: #753b3b;margin: 1.5% auto;border-bottom: #df1919 1px solid;">Для введенного Вами адреса электронной почты учетной записи не найдено</span>';
	}

?>
