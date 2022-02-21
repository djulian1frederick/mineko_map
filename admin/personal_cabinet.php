<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Личный кабинет</title>
	<link rel="stylesheet" href="../css/index.css">
<script src="../js/select2.min.js"></script>
<script src="js/menu.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
</head>
<body>
	<?php include('header.php');?>	
	<div class="container">
	<div class="blocks_info">
		<ul class="navigation-horizontal">
			<li  onclick="personal('pk')">Личные данные</li>
			<li onclick="personal('cont')">Контактные данные</li>
			<li onclick="personal('pass')">Смена пароля</li>
			<li onclick="personal('cancel_reg')">Отмена регистрации</li>
		</ul>	

		<div id="personal" style="width: 90%; padding: 0 5%; background: #fff;">
			
		</div>
		кекекекеке личный кабинет

		че тут

		смена пароля

		фио

		шо за организацию ты представляешь
	
	</div>
</div>
</body>
</html>

