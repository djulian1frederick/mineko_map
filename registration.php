<?php session_start(); ?>
<!DOCTYPE html5>
<html>
<head>
	<title>Регистрация в системе</title>
<meta charset="utf-8">
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php require_once('admin/connection.php');?>
<?php include 'header.php'; ?>

<div class="container">
	<div class="content">
	<?php if(!isset($_SESSION['id'])) { echo '<div class="registrate">
			<div class="login_form">	
				<img src="img/logo.png" alt="Логотип сайта" class="login_form_img"><br>
					<span>Подача заявки  на регистрацию личного кабинета организации</span><br><br>';
					include('reg_form.php'); 
			echo '</div>
			<div id="reg_attach"><p style="margin-top: -40px;text-align: left;margin-left: 55px;">Уже есть аккаунт? <a href="login">Войти</a></p>
			<p style="border-top: 1px solid; padding: 10px 0; width: 70%; margin: 0 15%">Продолжая регистрацию Вы соглашаетесь на обработку персональных данных и принимаете <a href="privacy.php">Политику конфиденциальности</a></p></div>
		</div>';}?>
	</div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>