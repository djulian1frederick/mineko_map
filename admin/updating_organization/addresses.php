<?php require_once('../connection.php'); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<?php require_once('../connection.php'); ?>
	<?php
		$org = $_POST['org_ident'];
		$sql_select_main = "SELECT id_address from predpriyatiya where id_predpriyatiya='".$org."'";
		$sql_main = mysqli_query($bd, $sql_select_main);
		$main_row = mysqli_fetch_array($sql_main);
		$id_address = $main_row['id_address'];
		$address_sql = "SELECT * from addresses where id_addr = '".$id_address."'";
		$address_query= mysqli_query($bd, $address_sql);
		$address = mysqli_fetch_array($address_query);
	?>


<div class="blocks_info">
	<div id="result">
		
	</div>
	<div class="update-block">
		<h3>Обновление адреса организации</h3>
			
			<label>Полный адрес</label><br>
			<?php echo '<input name="address" type="text" value="'.$address['full_address'].'" id="address" placeholder="Начните вводить адрес"><br>';?>
			<label>Номер здания</label><br>
			<input type="text" name="numberhouse" id="numberhouse" placeholder="Введите номер здания"><br>
			<button onclick="update_address()"><img src="../img/edit.png" width="16px" height="16px"></button>
			<button class="del_butt"><img src="../img/delete.png" width="16px" height="16px"></button>
	</div>
</div>