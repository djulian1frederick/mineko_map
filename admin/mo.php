<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery.tinyTips.js"></script>
<script type="text/javascript" src="../js/func_admin.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/select2.min.js"></script>
<link rel="stylesheet" href="../css/index.css">
<?php include('header.php');?>	
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<?php require_once("connection.php");?>
<div class="container">
<div class="blocks_info">
<div><span>Добавление руководителя района / надо добавить сюда обновление </span><br>
<label>Фамилия</label><br>
<input type="text" name="r_fam" id="r_fam"><br>
<label>Имя</label><br>
<input type="text" name="r_name" id="r_name"><br>
<label>Отчество</label><br>
<input type="text" name="r_otch" id="r_otch"><br>
<select name="raion" id="r_raion" class="js-example-basic-single">
	<option value="NULL">Не выбрано</option>
	<?php 
		$sql = "SELECT id_raion, raion from raions";
		$raion_list_q = mysqli_query($bd, $sql);
		$raion_list = mysqli_fetch_array($raion_list_q);
		do {
			echo '<option value="'.$raion_list['id_raion'].'">'.$raion_list['raion'].'</option>';
		}while ($raion_list=mysqli_fetch_array($raion_list_q));
	?>
</select><br>
<span>Контактные данные:</span><br>
<label>Номер телефона</label><br>
<input type="text" name="phone" id="phone1" maxlength="12"><br>
<label>Адрес электронной почты</label><br>
<input type="email" name="email" id="email"><br>
<button onclick="addto()">Добавить контакт</button><br>
</div></div>

<div class="blocks_info">
<div><span>Добавление Фотографии руководителю</span><br>
<form method="post" enctype="multipart/form-data" id="form_img" action="add_image.php">
<select name="rukovoditel" id="rukid" class="js-example-basic-single">
	<option value="">Не выбрано</option>
	<?php 
		$sql = "SELECT * from rukovoditeli join mo join raions where mo.id_rukovod=rukovoditeli.id_rukovoditel and mo.id_raion = raions.id_raion";
		$ruk_list_q = mysqli_query($bd, $sql);
		$ruk_list = mysqli_fetch_array($ruk_list_q);
		do {
			echo '<option value="'.$ruk_list['id_rukovoditel'].'">'.$ruk_list['second_name'].' '.$ruk_list['first_name'].' ('.$ruk_list['raion'].')</option>';
		}while ($ruk_list=mysqli_fetch_array($ruk_list_q));
	?>
</select><br>
<label>Фото</label><br>
<input type="file" name="file" id="r_file"><br>
<input type="submit" value="Прикрепить фото руководителю">
</form></div>
</div>

<div id="result">
	
</div>