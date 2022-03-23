<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<script src="../../js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../../js/script.js" type="text/javascript"></script>
<script src="../../js/select2.min.js"></script>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<link href="../../js/jquery.fias.min.css" rel="stylesheet">

<div class="blocks_info">
	<h3 style="width:auto; margin-top: 25px;">Добавление адресов организациям</h3>
			<label for="org">Выберите организацию</label><br>
			<select name="org" id="org" class="js-example-basic-single"  style="width: 450px;">
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
			<label>Полный адрес</label><br>
			<input name="address" type="text" value="" id="address" placeholder="Начните вводить адрес"><br>
			<label>Номер здания</label><br>
			<input type="text" name="numberhouse" id="numberhouse" placeholder="Введите номер здания"><br>
			<button onclick="add_address()"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
			<div id="result"></div>
</div>