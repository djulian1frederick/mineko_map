<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL && $_SESSION['level'] <> 3) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Пользователи системы</title>
	<link rel="stylesheet" href="../css/index.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../libs/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="../css/index.css">
</head>
<body>
<?php include('header.php');?>	
<?php require_once("connection.php");?>
<div class="container">
	<?php 
		// количество записей, выводимых на странице
		$per_page=2;
		// получаем номер страницы
		if (isset($_GET['page'])) $page=($_GET['page']-1); else $page=0;
		// вычисляем первый оператор для LIMIT
		$start=abs($page*$per_page);
		// составляем запрос и выводим записи
		// переменную $start используем, как нумератор записей.
		$q="SELECT * FROM `users` ORDER BY id_user LIMIT $start,$per_page";
		$res=mysqli_query($bd,$q);
		while($row=mysqli_fetch_array($res)) {
		  echo ++$start.". ".$row['id_user']."<br>\n";
		}

		// дальше выводим ссылки на страницы:
		$q="SELECT count(*) FROM users";
		$res=mysqli_query($bd,$q);
		$row=mysqli_fetch_row($res);
		$total_rows=$row[0];

		$num_pages=ceil($total_rows/$per_page);

		for($i=1;$i<=$num_pages;$i++) {
		  if ($i-1 == $page) {
		    echo $i." ";
		  } else {
		    echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i."</a> ";
		  }
		}

	?>
</div>
<div class="container">
	<div id="chosing">
		
	</div>
</div>