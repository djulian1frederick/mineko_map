<html>
<head>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="js/func.js"></script>
<link href="js/jquery.fias.min.css" rel="stylesheet">
<script src="js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="js/jquery.fias.min.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" href="css/index.css">
<title>Страница моей организации</title>
</head>
<?php include('header.php');?>	
		
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<body>
<?php require_once("connection.php");?>
<div class="container">
	<ul class="up-menu">
		<li onclick="open_info('main')">Основная информация об организации</li>
		<li onclick="open_info('contacts')">Контактные данные организации</li>
		<li onclick="open_info('production')">Продукция организации</li>
		<li onclick="open_info('profile')">Ваш профиль</li>
	</ul>
	<div class="content" id="window">
			
	</div>
</div>


</body>
</html>



