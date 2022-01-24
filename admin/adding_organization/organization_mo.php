<?php require_once('../connection.php'); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div class="blocks_info">
	<h3>Добавление организаций к муниципальному образованию</h3>
		<label for="orga_mo">Выберите организацию</label><br>
		<select name="orga_mo" id="orga_mo" class="js-example-basic-single"  style="width: 450px;">
			<option value="">Не выбрано</option>
			<?php 
				$sql = "SELECT id_predpriyatiya, name from predpriyatiya";
				$org_q = mysqli_query($bd, $sql);
				$org_l = mysqli_fetch_array($org_q);
				do {
					echo '<option value="'.$org_l['id_predpriyatiya'].'">'.$org_l['name'].'</option>';
				}while ($org_l=mysqli_fetch_array($org_q));
			?>	
		</select><br><br>
		<label for="orga_mo">Выберите муниципальное образование</label><br>
		<select name="ra_mo" id="ra_mo" class="js-example-basic-single" style="width: 450px;">
			<option value="">Не выбрано</option>
			<?php 
				$sql = "SELECT id_mo, raion from mo join raions where raions.id_raion=mo.id_raion";
				$rai_q = mysqli_query($bd, $sql);
				$rai_l = mysqli_fetch_array($rai_q);
				do {
					echo '<option value="'.$rai_l['id_mo'].'">'.$rai_l['raion'].'</option>';
				}while ($rai_l=mysqli_fetch_array($rai_q));
			?>	
		</select><br><br>
		<button onclick="addmo_to_org()"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
</div>