<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<script src="../../js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../../js/script.js" type="text/javascript"></script>
	<?php
		if(isset($_POST['org_ident'])){
			$org = $_POST['org_ident'];
			$_SESSION['org_addr'] = $org;
		}
		else
			{ 
		$org = $_SESSION['org_addr'];
			}
		$sql_select_main = "SELECT id_address from predpriyatiya where id_predpriyatiya='".$org."'";
		$sql_main = mysqli_query($bd, $sql_select_main);
		$main_row = mysqli_fetch_array($sql_main);
		$id_address = $main_row['id_address'];
		$address_sql = "SELECT * from addresses where id_addr = '".$id_address."'";
		$address_query= mysqli_query($bd, $address_sql);
		$address = mysqli_fetch_array($address_query);
	?>


<div class="blocks_info" id="address_block">
	
	<div class="update-block">
		<h3>Обновление адреса организации</h3>
			<?php echo '<input type="hidden" id="addr" value="'.$id_address.'">'; ?>
			<?php echo '<input type="hidden" id="organization" value="'.$org.'">'; ?>
			<label>Полный адрес*</label><br>
			<?php echo '<input name="address" type="text" value="'.$address['full_address'].'" id="address" placeholder="Начните вводить адрес"><br>';?>
			<label>Номер здания, если есть</label><br>
			<input type="text" name="numberhouse" id="numberhouse" placeholder="Введите номер здания" maxlength="5"><br>
			<button onclick="update_address()"><img src="../img/edit.png" width="16px" height="16px"></button>
			<button class="del_butt"><img src="../img/delete.png" width="16px" height="16px"></button>
			<p>* - при вводе адреса не может быть указан номер дома</p>
	</div>
	<div id="result_operation"></div>
</div>