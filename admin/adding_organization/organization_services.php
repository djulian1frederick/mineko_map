<?php require_once('../connection.php'); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div id="result">
	
</div>
<div class="blocks_info">
	<h3>Добавление услуг, предоставленных центром</h3>
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
		<label for="orga_mo">Услуга</label><br>
		<textarea name="exp_service" id="exp_service" cols="40" rows="10"></textarea><br><br>
		<button onclick="addservices_to_org()"><img src="../img/plus.png" width="16px" height="16px">Добавить</button><br>
</div>