<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div class="blocks_info">
	<div style="width: 100%; background: #fff;">
		<h3>Добавление или изменения ответственного за экспорт в районе</h3>
		<div style="margin: 10px 15px;">
			<label>Фамилия *</label>
			<br>
			<input type="text" name="r_fam" id="r_fam" required placeholder="Введите фамилию ответственного за экспорт">
			<br>
			<label>Имя *</label>
			<br>
			<input type="text" name="r_name" id="r_name" required placeholder="Введите имя ответственного за экспорт">
			<br>
			<label>Отчество</label>
			<br>
			<input type="text" name="r_otch" id="r_otch" placeholder="Введите отчество ответственного за экспорт">
			<br>
			
		<?php if($_SESSION['level'] == '3')  { echo 
			'<label for="r_raion">Муниципальное образование *</label>
				<br>
				<select name="raion" id="r_raion" class="js-example-basic-single" style="width: 450px; max-width: 100%;">
				<option value="NULL">Не выбрано</option>';
				 
					$sql = "SELECT raion, id_mo from raions join mo on mo.id_raion=raions.id_raion";
					$raion_list_q = mysqli_query($bd, $sql);
					$raion_list = mysqli_fetch_array($raion_list_q);
					do {
						echo '<option value="'.$raion_list['id_mo'].'">'.$raion_list['raion'].'</option>';
					}while ($raion_list=mysqli_fetch_array($raion_list_q));
			echo 
			'</select>
			<br>';}
			elseif ($_SESSION['level'] == '2') {
				$admin_id = mysqli_query($bd, "SELECT id_admin from admins where id_user='".$_SESSION['user_id']."'");
				$admin_id = mysqli_fetch_array($admin_id);
				$admin_id = $admin_id['id_admin'];
				$id_mo = mysqli_query($bd, "SELECT id_mo from mo where id_admin='".$admin_id."'");
				$id_mo = mysqli_fetch_array($id_mo);
				$id_mo_l = $id_mo['id_mo'];
				echo '<input type="hidden" value="'.$id_mo_l.'" id="r_raion" name="raion">';
			}?>
			<label>Должность*:</label>
			<br>
			<input type="text" name="post" id="post" placeholder="Введите должность ответственного за экспорт">
			<br>
			<label>Контактные данные:</label>
			<br>
			<label>Номер телефона</label>
			<br>
			<input type="text" name="phone" id="phone1" maxlength="12" placeholder="Введите контактный номер ответственного за экспорт" value="+7">
			<br>
			<label>Адрес электронной почты</label>
			<br>
			<input type="email" name="email" id="email" placeholder="Введите адрес электронной почты ответственного за экспорт">
			<br>
			<button onclick="addto_responsiblies()">
				<img src="../img/plus.png" width="16px" height="16px"> Добавить
			</button>
			<br>
			<p class="necess">* - Обязательное поле</p>
			<div id="answer">
				
			</div>
		</div>
	</div>
</div>