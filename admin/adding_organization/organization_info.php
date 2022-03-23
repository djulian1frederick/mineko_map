<?php  session_start(); ?>
<?php require_once("../connection.php"); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div class="blocks_info">
	<h3 style="width:auto; margin-top: 25px;">Добавление организаций</h3>
		<div style="width: 100%; background: #fff;padding: 2.5%;">
			<label for="">Название организации*</label><br>
			<input type="text" required id="nameorg" name="nameorg" placeholder="Введите название организации" required><br><br>
			<label for="">ИНН*</label><br>
			<input type="text" pattern="\d*" required id="inn" name="inn" maxlength="10" placeholder="Введите ИНН" required><br><br>
			<label for="">ОГРН*</label><br>
			<input type="text" pattern="\d*" required id="ogrn" name="ogrn" maxlength="15" placeholder="Введите ОГРН" required><br><br>
			<label>Год начала экспортной деятельности</label><br>
			<input type="text" pattern="\d*" name="year" id="year" placeholder="Введите год"><br>
			<?php if($_SESSION['level'] <> '2') { echo '
			<br><label for="ra_mo">Выберите муниципальное образование</label><br>
			<select name="ra_mo" id="ra_mo" class="js-example-basic-single" style="width: 450px; max-width: 100%;">
				<option value="">Не выбрано</option>';

					$sql = "SELECT id_mo, raion from mo join raions where raions.id_raion=mo.id_raion";
					$rai_q = mysqli_query($bd, $sql);
					$rai_l = mysqli_fetch_array($rai_q);
					do {
						echo '<option value="'.$rai_l['id_mo'].'">'.$rai_l['raion'].'</option>';
					}while ($rai_l=mysqli_fetch_array($rai_q));
			echo '</select><br><br>'; } 
			elseif($_SESSION['level'] == '2') {
				$admin_id = mysqli_query($bd, "SELECT id_admin from admins where id_user='".$_SESSION['user_id']."'");
				$admin_id = mysqli_fetch_array($admin_id);
				$admin_id = $admin_id['id_admin'];
				$id_mo = mysqli_query($bd, "SELECT id_mo from mo where id_admin='".$admin_id."'");
				$id_mo = mysqli_fetch_array($id_mo);
				$id_mo_l = $id_mo['id_mo'];
				echo '<input type="hidden" value="'.$id_mo_l.'" id="ra_mo" name="ra_mo">';
			} ?>
			<button onclick="addorganization()" type="submit" class="add_but"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
			<p class="necess">* - Обязательное поле</p>
			<div id="result"></div>
		</div>
</div>