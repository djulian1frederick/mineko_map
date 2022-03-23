<?php session_start(); ?>
<?php require_once("../connection.php"); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<div class="blocks_info">
	<h3 style="width:auto; margin-top: 25px;">Добавление руководителей</h3>
		<div style="width: 100%; background: #fff;padding: 2.5%;">
		<label for="org_con">Выберите организацию</label><br>
		<select name="org_con" id="org_con" class="js-example-basic-single" style="max-width: 450px; width: 100%">
			<option value="">Не выбрано</option>
			<?php 
			if($_SESSION['level'] <> '2') {
				$sql = "SELECT id_predpriyatiya, name from predpriyatiya";}
				elseif ($_SESSION['level'] == '2') {
						$admin_id = mysqli_query($bd, "SELECT id_admin from admins where id_user='".$_SESSION['user_id']."'");
						$admin_id = mysqli_fetch_array($admin_id);
						$admin_id = $admin_id['id_admin'];
						$id_mo = mysqli_query($bd, "SELECT id_mo from mo where id_admin='".$admin_id."'");
						$id_mo = mysqli_fetch_array($id_mo);
						$id_mo = $id_mo['id_mo'];
						$sql = "SELECT id_predpriyatiya, name from predpriyatiya where id_mo='".$id_mo."'";
				}
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
		<div style="border: 1px dotted; width: 90%; margin:2px 2.5%;">
			<span>Контактные данные</span><br>
			<label>Номер телефона</label><br>
			<input type="text" name="org_phone1" id="org_phone1" maxlength="12" placeholder="Введите номер контактного телефона"><br>
			<label>Адрес электронной почты</label><br>
			<input type="email" name="organ_email" id="org_email" placeholder="Введите адрес электронной почты"><br>
		</div>
		<button onclick="addcontacts_to_organization()" type="submit"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
		<p class="necess">* - Обязательное поле</p>
		<div id="updateinfo"></div>
	</div>
</div>