<?php 
	session_start();
	require_once("../connection.php");

	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$id_con = $_POST['id_con'];
	$id_check = $_POST['id_check'];

	$success = "Ваш номер телефона был успешно обновлен";
	$unsuccess = "Произошла ошибка при попытки изменения данных";
	

	if($id_check <> NULL) {
		if(isset($_SESSION['user_id'])) {
			$sql = "UPDATE checking_registration set phone='".$phone."' where id_check='".$id_check."'";
			$query_update_check = mysqli_query($bd, $sql);
			if($query_update_check) {echo "<span>".$success."</span>";}
			else {	echo "<span>".$unsuccess."</span>";	}		
		}
	}
	if($id_con <> NULL) {
		if(isset($_SESSION['user_id'])) {
			$sql = "UPDATE contacts set phone1='".$phone."' where id_contact='".$id_con."'";
			$query_update_check = mysqli_query($bd, $sql);
			if($query_update_check) {echo "<span>".$success."</span>";}
			else {	echo "<span>".$unsuccess."</span>";	}	
		}	
	}

	$sql_check_email = mysqli_query($bd, "SELECT user_email from users where id_user='".$_SESSION['user_id']."'");
	$check_email = mysqli_fetch_array($sql_check_email);
	$actual_email = $check_email['user_email'];
	if($email <> $actual_email) {
		$check_emails = mysqli_query($bd, "SELECT user_email from users where user_email='".$email."'");
		$check_emails = mysqli_fetch_array($check_emails);
		if($check_emails == NULL) {
			$activation=md5($email.time()); // email + timestamp
			$active_hash_update = mysqli_query($bd, "UPDATE users set active_hash='".$activation."' where id_user='".$_SESSION['user_id']."'");
			
			$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
					$root_dir = $url;

						$date = date('dm');
						// отправка письма
						// Формирование самого письма
						$title = "Подтверждение email адреса учетной записи";
						$body = "<h2>Уважаемый пользователь!</h2>
						<b>Вами было запрошено изменение адреса электронной почты, чтобы применить изменения необходимо перейти по следующей ссылке:</b><br>
						<b><a href='".$root_dir."/mail-change?l=".$activation."&e=".$actual_email."&t=".$email."&d=".$date."'>".$root_dir."/mail-change</a><br><br><br><br><br><br><br><br>";
					$msg = "<span>Ссылка с активацией нового почтового адреса отправлена на указанную почту</span>";
				}
				else {
					$msg = "<span>Данный адрес уже используется</span>";
				}
	}


	if($id_check == NULL && $id_con == NULL && isset($_SESSION['user_id']))
	{
		$sql_insert = "INSERT into contacts (phone1, email) values ('".$phone."','".$email."')";
		$query_insert = mysqli_query($bd,$sql_insert);
		
		if($query_insert){ echo  "<span>".$success."</span>";}
			else {	echo "<span>".$unsuccess."</span>";	}	
		
		$sql_check_email = mysqli_query($bd, "SELECT user_email from users where id_user='".$_SESSION['user_id']."'");
		
		$check_email = mysqli_fetch_array($sql_check_email);
		$actual_email = $check_email['user_email'];
		if($email <> $actual_email) {
			$check_emails = mysqli_query($bd, "SELECT user_email from users where user_email='".$email."'");
			$check_emails = mysqli_fetch_array($check_emails);
			if($check_emails == NULL) {
				$activation=md5($email.time()); // email + timestamp
				$active_hash_update = mysqli_query($bd, "UPDATE users set active_hash='".$activation."' where id_user='".$_SESSION['user_id']."'");
				
							$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
							$root_dir = $url;

							$date = date('dm');
							// отправка письма
							// Формирование самого письма
							$title = "Подтверждение email адреса учетной записи";
							$body = "<h2>Уважаемый пользователь!</h2>
							<b>Вами было запрошено изменение адреса электронной почты, чтобы применить изменения необходимо перейти по следующей ссылке:</b><br>
							<b><a href='".$root_dir."/mail-change?l=".$activation."&e=".$actual_email."&t=".$email."&d=".$date."'>".$root_dir."/mail-change</a><br><br><br><br><br><br><br><br>";
					$msg = "<span>Ссылка с активацией нового почтового адреса отправлена на указанную почту</span>";
					}
					else {
						$msg = "<span>Данный адрес уже используется</span>";
					}
		}
	}
	include 'mail_to.php';
	echo '<br>'.$msg;
?>