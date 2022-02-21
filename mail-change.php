<?php 
session_start();
$user_id = $_SESSION['user_id'];

$active_hash = $_GET['l'];
$email_old = $_GET['e'];
$new_email = $_GET['t'];
$date_reactive = intval($_GET['d']);
$date_to_check = intval(date('dm'));

$d1 = strval($date_reactive);
$d2 = strval($date_to_check);

if (strcmp($d1, $d2) == 0) {

	require_once('admin/connection.php');
	$sql = "SELECT activate_hash from users where user_email='".$email_old."' and id_user='".$user_id."'";
	$query = mysqli_query($bd, $sql);
	$row_activate = mysqli_fetch_array($query);
	$active_hash_check = $row_activate['activate_hash'];
	if($active_hash_check == $active_hash) {
		$sql = "UPDATE users set user_email = '".$new_email."' where user_email='".$email_old."' and activate_hash='".$active_hash_check."'";
		$update = mysqli_query($bd, $sql);
		$msg = '<span>Ваш email адрес  был успешно изменен.</span>';
		$email = $email_old;
		$title = "Изменения email адреса учетной записи";
		$body = "<h2>Уважаемый пользователь!</h2>
			<b>Вами был изменен адрес электронной почты на '".$new_email."'. Если это были не Вы, срочно свяжитесь с нами.
			<br><br><br><br><br><br><br><br>";
		include($_SERVER['DOCUMENT_ROOT'].'/email-activate/send.php');

	}
}
	else {
		$msg = '<span>Код изменения адреса истек. Попробуйте снова.</span>';
	}

?>
<!DOCTYPE html5>
<html>
<head>
	<title>Обновление email в системе</title>
<meta charset="utf-8">
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
	<div class="content">
	<?php echo $msg; ?>
	</div>
</div>
</body>
</html>