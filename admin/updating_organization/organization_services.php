<?php require_once('../connection.php'); ?>
<?php
		$org = $_POST['org_ident'];
		$sql_select_main = "SELECT * from predpriyatiya where id_predpriyatiya='".$org."'";
		$sql_main = mysqli_query($bd, $sql_select_main);
		$main_row = mysqli_fetch_array($sql_main);
	?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div id="result">
	
</div>
<div class="blocks_info">
	<h3>Обновление услуг, предоставленных центром</h3>
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
		</select>
		<br>
		<button onclick="openservices()">Выбрать</button><br>
	<div id="services"></div>
</div>