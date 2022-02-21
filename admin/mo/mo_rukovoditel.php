<?php require_once('../connection.php'); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div class="blocks_info">
	<h3>Добавление руководителя района</h3>
	<label>Фамилия</label><br>
	<input type="text" name="r_fam" id="r_fam" required placeholder="Введите фамилию руководителя МО"><br>
	<label>Имя</label><br>
	<input type="text" name="r_name" id="r_name" required placeholder="Введите имя руководителя МО"><br>
	<label>Отчество</label><br>
	<input type="text" name="r_otch" id="r_otch" placeholder="Введите отчество руководителя МО"><br>
	<label for="r_raion">Муниципальное образование</label><br>
	<select name="raion" id="r_raion" class="js-example-basic-single" style="width: 450px;">
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
	<input type="text" name="phone" id="phone1" maxlength="12" placeholder="Введите контактный номер руководителя МО"><br>
	<label>Адрес электронной почты</label><br>
	<input type="email" name="email" id="email" placeholder="Введите адрес электронной почты"><br>
	<button onclick="addto()"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
		<p style="margin: 5px 0; padding: 2px; border-top: 3px solid #000; font-family: Circe; width: 450px; color: #1c75bc; font-weight: bold;">* - Обязательное поле</p>
	</div>
</div>