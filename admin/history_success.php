<?php session_start();
	if(!isset($_SESSION['user_id']) || $_SESSION['level'] <> 3) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Добавление достижений</title>
	<link rel="stylesheet" href="../css/index.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../libs/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="../css/index.css">
</head>
<body onload="open_add()">
<?php include('header.php');?>	
<?php require_once("connection.php");?>
<div class="container">
	<div class="content" style="min-height: 70px; background: #fff; padding: 1.5%;">
		<button class="button" onclick="open_add()">Добавление*</button>
		<button class="button" onclick="open_edit()">Редактирование</button>
	<br><p style="font-style: italic; font-size: 10px; padding: 5px; margin: 0 auto;">* - Открыто по умолчанию</p>
	</div>
</div>
<div class="container">
	<div id="chosing" style="min-height: 500px;background: #fff;margin: 0 5%;width: 90%;">
		
	</div>
</div>
<?php require_once('footer.php'); ?>

<script>
	function open_add() {
		jQuery.ajax({
            url: "achievments.php", //url-адрес, по которому будет отправлен запрос
            success:function(html){
           		 $('#chosing').html(html);
        	},
        });
	}
	function open_edit() {
		jQuery.ajax({
            url: "achievments_edit.php", //url-адрес, по которому будет отправлен запрос
            success:function(html){
           		 $('#chosing').html(html);
        	},
        });
	}
</script>

<style>
	.button {
		    border: none;
    cursor: pointer;
    padding: 10px;
    margin: 2.5px 5px;
    background: #1c75bc;
    color: white;
    font-family: 'Circe Light';
	}
</style>