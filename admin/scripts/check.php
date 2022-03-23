<?php 
	session_start();
	require_once("../connection.php");

	$id = $_POST['checks'];
	$button = $_POST['button'];

	$sql = "SELECT * from checking_registration where id_check = '".$id."'";
		$query = mysqli_query($bd, $sql);
		$row_main = mysqli_fetch_array($query);

		$sql = "SELECT user_email from users where id_user='".$row_main['id_user']."'";
		$email = mysqli_query($bd, $sql);
		$email = mysqli_fetch_array($email);
		$email = $email['user_email'];

	if($button == 'confirm') {
				$contacts_add = mysqli_query($bd, "INSERT into contacts (email, phone1) value ('".$email."','".$row_main['phone']."')");
		$contacts_get_id = mysqli_query($bd, "SELECT id_contact from contacts where email='".$email."' and phone1='".$row_main['phone']."'");
		$contacts_get_id = mysqli_fetch_array($contacts_get_id);
		$contacts_get_id = $contacts_get_id['id_contact'];

		$con_people_add = mysqli_query($bd, "INSERT into contacts_people(first_name_con, second_name_con,id_contact, id_user) values ('".$row_main['first_name_reg']."','".$row_main['second_name_reg']."','".$contacts_get_id."','".$row_main['id_user']."')");
		if($row_main['last_name_reg'] <> NULL) {
			$con_people_add = mysqli_query($bd, "UPDATE contacts_people set last_name_con='".$row_main['last_name_reg']."'");
		}

		$con_people_id = mysqli_query($bd, "SELECT id_con_people from contacts_people where id_contact='".$contacts_get_id."' and id_user='".$row_main['id_user']."'");
		$con_people_id = mysqli_fetch_array($con_people_id);
		$con_people_id = $con_people_id['id_con_people'];

		$add_organization = mysqli_query($bd, "INSERT into predpriyatiya (id_con_people, inn, name, id_mo) values ('".$con_people_id."','".$row_main['inn']."','".$row_main['name_org']."','".$row_main['mo']."')");
		if($add_organization) {
			$change_check = mysqli_query($bd, "update checking_registration set status_check='1' where id_check='".$id."'");
			$change_rules = mysqli_query($bd, "update admins set level='1' where id_user='".$row_main['id_user']."'");
			if($change_check) {
				echo '<meta http-equiv="refresh" content="5;URL=../status_check">';
				header('Refresh: 5, url: ../status_check.php');
				$msg ='<span>Организация была зарегистрирована. Пользователю будет доставлено письмо с дальнейшими инструкциями.</span>';
				$title = "Статус регистрации организации на портале";
				$body = "<h2>Уважаемый пользователь!</h2>
					<b>Ваша организация «".$row_main['name_org']."» на портале 'Экспортного каталога Оренбургской области' была зарегистрирована. Вам необходимо заполнить информацию об организации в личном кабинете организации. Для того, чтобы это сделать авторизуйтесь в системе и перейдите к «Личному кабинету организации»</b><br>
						<br><br><br><br>";
					include("mail_to.php");
			}
			else {
				header('Refresh: 5, url: "/editor/status_check"');
				$msg ='Произошла непридвиденная ошибка.';
			}
		}

	}
	elseif($button == 'deny') {
			$change_check = mysqli_query($bd, "update checking_registration set status_check='2' where id_check='".$id."'");
			if($change_check){
				echo '<meta http-equiv="refresh" content="5;URL=../status_check">';
				$msg ='<span>Организации отказано в регистрации. Пользователю будет доставлено соответствующее письмо.</span>';
				$title = "Статус регистрации организации на портале";
				$body = "<h2>Уважаемый пользователь!</h2>
					<b>Ваша организация «".$row_main['name_org']."» на портале 'Экспортного каталога Оренбургской области' не была зарегистрирована в связи с несоответствием ИНН. Для изменения данных или удаления заявки, пожалуйста, свяжитесь с администратором <a href='#'>на следующей странице (заглушка)</a></b><br>
						<br><br><br><br>";
					include("mail_to.php");
			}
	}
?>

<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Изменение статуса</title>
	<link rel="stylesheet" href="../../css/index.css">
<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php include('../header.php');?>	
<div class="container">
	<div class="content">
		<div class="block_info_load">
			<?php echo "<script>alert(".$msg."');</script>"; ?>
		</div>
	</div>
</div>
</body>
</html>