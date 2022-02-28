<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<?php 
	$password_cur = $_POST['password_cur'];
	$pass_once = $_POST['password_once'];
	$pass_repeat = $_POST['password_repeat'];

	$user = mysqli_query($bd, "SELECT password from users where id_user='".$_SESSION['user_id']."'");
	$user = mysqli_fetch_array($user);
	$password = $user['password'];
	if(password_verify($password_cur, $password)){

	if($pass_once == $pass_repeat) {
		$query = mysqli_query($bd, "SELECT user_email from users where id_user='".$_SESSION['user_id']."'");
		$row = mysqli_fetch_array($query);
		$email = $row['user_email'];
		$pass_true = password_hash($pass_repeat, PASSWORD_DEFAULT);
		$update_pass = mysqli_query($bd, "UPDATE users set password='".$pass_true."' where id_user='".$_SESSION['user_id']."'");
		if($update_pass) {
			$msg = "Пароль успешно изменен";
			$title = "Сброс пароля учетной записи";
			$body = "<div style='font-family: Circe;'><h2>Уважаемый пользователь!</h2>
			<b>Вами был изменен пароль вашей учетной записи на портале 'Экспортного каталога Оренбургской области' ".$today."</b><br><br><br><br><br></div>";
			include("mail_to.php");
		}
		else {
			$msg = "Что-то пошло не так, попробуйте позже";
		}
	}
	else{
		$msg = "Введенные пароли не совпадают";
	}
}
	else {
		$msg = "Текущий пароль введен неверно";
	}
	echo '<span class="message">'.$msg.'</span>';
?>