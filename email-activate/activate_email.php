<!DOCTYPE html5>
<html>
<head>
	<title>Подтверждение учетной записи</title>
<meta charset="utf-8">
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="../css/index.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
	<div class="content">
		<?php 

			$hash = $_GET['l'];

			require_once("../admin/connection.php");
			require_once("../admin/translit.php");
			$sql = "SELECT active_hash, id_user, user_email, activation from users where active_hash='".$hash."'";
			$checking = mysqli_query($bd, $sql);
			$activehash = mysqli_fetch_array($checking);
			$id_user=$activehash['id_user'];
			$email = $activehash['user_email'];
			$status = $activehash['activation'];
			$activehash=$activehash['active_hash'];
			if($activehash == $hash && $status == "0") {
				$activate_email = mysqli_query($bd, "UPDATE users set activation='1' where id_user='".$id_user."'");
				if($activate_email) {
					$msg = "<p>Ваш email успешно активирован</p>";
				}
				$creating_login = mysqli_query($bd, "select second_name_reg from users join checking_registration on checking_registration.id_user=users.id_user where users.id_user='".$id_user."'");
				$creating_login = mysqli_fetch_array($creating_login);
					$name_login = $creating_login['second_name_reg'];
					$date_create = date("mdy");
					$user_login = translit($name_login);
					$user_login = "".$user_login."".$date_create."";
						$login_update = mysqli_query($bd, "UPDATE users set user_login='".$user_login."' where id_user='".$id_user."'");
						$admin_update=mysqli_query($bd, "INSERT into admins (id_user, level) values('".$id_user."','0')");
						if ($login_update) {
							$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
							$root_dir = $url;
							
							$msg .= "<p>Вам присвоен логин ".$user_login.", который также может быть использован при авторизации</p>";
							$msg .= "<p><a href='../login'>Войти</a></p>";
							$title = "Успешная регистрация учетной записи";
							$body = "<div style='font-family: Circe;'><h2>Уважаемый пользователь, !</h2>
							<b>Вам был присвоен логин ".$user_login." на портале 'Экспортного каталога Оренбургской области', который Вы можете использовать при авторизации помимо адреса электронной почты.<br> Для того, чтобы войти в систему, Вам необходимо перейти по следующей <a href='".$root_dir."/login'>ссылке</a></b><br><br><br><br><br></div>";
							include("send.php");
						}
			}
			elseif($status == "1") {
				$msg = "<p>Ваш email уже подтвержден</p>";
				$msg .= "<p><a href='../login'>Войти</a></p>";
			}
			else {
				$msg = "<p>Произошла ошибка активации. <a href='#'>Сгенерировать новое подтвеждение?</a></p>";
			}

			echo $msg;

		?>	
	</div>
</div>
</body>
</html>