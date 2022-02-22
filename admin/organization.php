<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Режим добавления организаций</title>
	<link rel="stylesheet" href="../css/index.css">
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/func_update.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/func.js" type="text/javascript"></script>
<script src="../js/select2.min.js"></script>
<script src="js/menu.js"></script>
<script src="js/func_update_organization.js"></script>
<link rel="stylesheet" href="../css/index.css">
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
</head>
<body>
<?php include('header.php');?>	
<?php require_once("connection.php");?>

</div>
<div class="container">

		<ul class="edit-navigation">
			<li  onclick="position('info')">Основная информация об организациях</li>
			<li onclick="position('rukovoditeli')">Руководители организаций</li>
			<li onclick="position('addresses')">Адреса организаций</li>
			<li onclick="position('mo')">Принадлежность к муниципальному образованию</li>
			<li><span onclick="position('services')">Услуги, выданные организациям</span>
				<ul><li onclick="open_menu('services')">Отредактировать услуги</li></ul>
			</li>
		</ul>	

		<div id="position_result" style="width: 90%; padding: 0 5%; background: #fff;">
			
		</div>
</div>

</body>
</html>