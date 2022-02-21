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
	<div id="result">
		
	</div>
	<h3>Добавление адресов организациям</h3>
			<label for="org">Выберите организацию</label><br>
			<select name="org" id="org" class="js-example-basic-single"  style="width: 450px;">
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
			<label>Полный адрес</label><br>
			<input name="address" type="text" value="" id="address" placeholder="Начните вводить адрес"><br>
			<label>Номер здания</label><br>
			<input type="text" name="numberhouse" id="numberhouse" placeholder="Введите номер здания"><br>
			<button onclick="add_address()"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
</div>