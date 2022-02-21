<?php require_once("../connection.php"); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div id="result">
			
</div>
<div class="blocks_info">
	<h3>Добавление руководителей</h3>
		<div>
		<label for="org_con">Выберите организацию</label><br>
		<select name="org_con" id="org_con" class="js-example-basic-single" style="width: 450px;">
			<option value="">Не выбрано</option>
			<?php 
				$sql = "SELECT id_predpriyatiya, name from predpriyatiya";
				$org_q = mysqli_query($bd, $sql);
				$org_l = mysqli_fetch_array($org_q);
				do {
					echo '<option value="'.$org_l['id_predpriyatiya'].'">'.$org_l['name'].'</option>';
				}while ($org_l=mysqli_fetch_array($org_q));
			?>
		</select><br>
		<label>Фамилия *</label><br>
		<input type="text" name="o_fam" id="o_fam" required placeholder="Введите фамилию руководителя"><br>
		<label>Имя *</label><br>
		<input type="text" name="o_name" id="o_name" required placeholder="Введите имя руководителя"><br>
		<label>Отчество</label><br>
		<input type="text" name="o_otch" id="o_otch" placeholder="Введите отчество руководителя (при наличии)"><br>
		<span>Контактные данные</span><br>
		<label>Номер телефона</label><br>
		<input type="text" name="org_phone1" id="org_phone1" maxlength="12" placeholder="Введите номер контактного телефона"><br>
		<label>Адрес электронной почты</label><br>
		<input type="email" name="organ_email" id="org_email" placeholder="Введите адрес электронной почты"><br>
		<p style="margin: 5px 0; padding: 2px; border-top: 3px solid #000; font-family: Circe; width: 450px; color: #1c75bc; font-weight: bold;">* - Обязательное поле</p>
		<button onclick="addcontacts_to_organization()" type="submit"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
	</div>
</div>