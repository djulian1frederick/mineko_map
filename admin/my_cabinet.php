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
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="js/func_update_organization.js"></script>
<script src="../js/select2.min.js"></script>
<script src="js/menu.js"></script>
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
			<div class="update-block" style="margin: -15px 5px -15px 5px;">
			<div id="personal" style="width: 90%; padding: 0 5%; background: #fff;">
				
			</div>
		</div>	
	</div>
</div>
</body>
</html>

<style>
	.blocks_info {
		width: 100%;
	}
	.navigation-horizontal{
		width: 100%;
		margin: auto;
		text-align: center;
	}
	.navigation-horizontal li {
		width: 23.5%;
		margin: auto;
		border-top-right-radius: 15px;
	}
</style>
