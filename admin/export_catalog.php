<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Поиск</title>
	<link rel="stylesheet" href="../css/index.css">
</head>
<body>
	<?php include('header.php');?>	
<div class="container">
	<div class="content">
		шлюшка-заглушка
	</div>
</div>
</body>
</html>


