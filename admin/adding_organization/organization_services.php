<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<div class="blocks_info">
	<h3 style="width:auto; margin-top: 25px;">Добавление услуг, предоставленных центром</h3>
		<label for="orga_mo">Выберите организацию</label><br>
		<select name="orga_mo" id="orga_mo" class="js-example-basic-single"  style="max-width: 450px; width: 100%;">
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
		</select><br><br>
		<label for="orga_mo">Услуга</label><br>
		<textarea name="exp_service" id="exp_service" cols="40" rows="10"></textarea><br><br>
		<button onclick="addservices_to_org()"><img src="../img/plus.png" width="16px" height="16px">Добавить</button><br>
		<div id="result"></div>
</div>