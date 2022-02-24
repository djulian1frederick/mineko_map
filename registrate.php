<?php session_start();?>
<div class="content">
	
<?php 
	require_once("admin/connection.php");
	
	$success_msg = "<span>Пользователь создан. Для отслеживания подтвердите адрес электронной почты</span>";
	$unsuccess_msg = "<span>Пользователь не был создан. Проверьте правильность ввода данных</span>";

	$secname = $_POST['secondname'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

	$inn_org = $_POST['inn_org'];
	$mo = $_POST['ra_mo'];
	$nameorg = $_POST['nameorg'];

	$email = $_POST['email'];

	$check_email = mysqli_query($bd, "select user_email from users where user_email='".$email."'");
	$check_email = mysqli_fetch_array($check_email);


	$phone = $_POST['phone'];
	$plainpassword = $_POST['password'];

	$password = password_hash($plainpassword, PASSWORD_DEFAULT);

	
	$date_created = date("Y-m-d");
	
	if($check_email == NULL) {
		$sql_query = "INSERT into users (user_email, password, date_create) values ('".$email."','".$password."','".$date_created."')";
		$query = mysqli_query($bd, $sql_query);
		if ($sql_query) {
			$sql_select = "SELECT id_user from users where password='".$password."' and user_email ='".$email."'";
			$select_query = mysqli_query($bd, $sql_select);
			$selecting_row = mysqli_fetch_array($select_query);
			$id_u = $selecting_row['id_user'];

			$activation=md5($email.time()); // email + timestamp
			$active_hash_update = mysqli_query($bd, "UPDATE users set active_hash='".$activation."' where id_user='".$id_u."'");
				$check_exists = mysqli_query($bd, "select inn from checking_registration where inn='".$inn_org."'");
				$check_exists = mysqli_fetch_array($check_exists);
				if ($check_exists <> NULL) {
					$success_msg .= "<br><span>Организация, которую Вы указали, уже находится на проверке.</span>";
					echo $success_msg;
				}
				else {
					$success_msg .= "<br><span>Ожидается проверка организации администратором.</span>";
					$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
					$root_dir = $url;

					// отправка письма
					// Формирование самого письма
					$title = "Подтверждение email адреса для активации учетной записи";
					$body = "<h2>Уважаемый пользователь!</h2>
					<b>Для того, чтобы активировать учетную запись на портале 'Экспортного каталога Оренбургской области' необходимо перейти по следующей ссылке:</b><br>
					<b><a href='".$root_dir."/email-activate/activate_email?l=".$activation."'>".$root_dir."/email-activate/activate_email</a><br><br><br><br><br><br><br><br>";
					include_once('email-activate/send.php');

					$checking_insert = "INSERT into checking_registration (id_user, name_org,  mo, inn, first_name_reg, second_name_reg, phone) values ('".$id_u."','".$nameorg."','".$mo."','".$inn_org."','".$firstname."','".$secname."', '".$phone."')";
					$checking_query = mysqli_query($bd, $checking_insert);
					if ($checking_query && $lastname <> '') {
						$update_last_name = "UPDATE checking_registration set last_name_reg='".$lastname."' where id_user='".$id_u."'";
						$update_last_name_query = mysqli_query($bd, $update_last_name);
						if($update_last_name_query) {
							echo $success_msg;
						}
					}
					elseif($checking_query) {
						echo $success_msg;
					}
					else {
						echo $unsuccess_msg;
					}
				}
		}
	}
	else {
		echo '<br><span>Данный адрес электронной почты уже используется</span>';
	}

?>
</div>