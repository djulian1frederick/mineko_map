<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Режим редактирования</title>
	<link rel="stylesheet" href="../css/index.css">
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
</head>
<body>
	<?php include('header.php');?>	
	<div class="container">
	<div class="blocks_info" style="height: 100%; min-height: 500px; width: 100%;">
		<p>Добро пожаловать в личный кабинет</p>
	
	</div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>

