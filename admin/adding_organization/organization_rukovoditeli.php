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
		<div style="background: azure;">
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
		<label for="post">Должность</label><br>
		<input type="text" name="post" id="post" placeholder="Введите должность руководителя (при наличии)"><br><br><br>
		<div style="border: 1px dotted; width: fit-content;">
			<span>Контактные данные</span><br>
			<label>Номер телефона</label><br>
			<input type="text" name="org_phone1" id="org_phone1" maxlength="12" placeholder="Введите номер контактного телефона"><br>
			<label>Адрес электронной почты</label><br>
			<input type="email" name="organ_email" id="org_email" placeholder="Введите адрес электронной почты"><br>
		</div>
		<button onclick="addcontacts_to_organization()" type="submit"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
		<p class="necess">* - Обязательное поле</p>
		
	</div>
</div>