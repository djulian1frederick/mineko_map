<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<?php require_once('../connection.php'); ?>
	<?php
		$org = $_POST['org_ident'];
		$sql_select_main = "SELECT * from predpriyatiya where id_predpriyatiya='".$org."'";
		$sql_main = mysqli_query($bd, $sql_select_main);
		$main_row = mysqli_fetch_array($sql_main);
	?>
<div class="blocks_info">
	<div class="update-block">
		<div style="margin: 0 2.5%;">	
					<?php
						$rukovoditel_select = "SELECT * from rukovoditeli where id_rukovoditel = '".$main_row['id_rukovoditel']."'";
						$rukovoditel_sql = mysqli_query($bd, $rukovoditel_select);
						$rukovoditel = mysqli_fetch_array($rukovoditel_sql); 
					?>
				<?php echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';?>
				<?php echo '<input type="hidden" name="ruk_id" id="ruk_id" value="'.$rukovoditel['id_rukovoditel'].'">';?>
			<label>Фамилия</label><br>
				<?php echo '<input type="text" name="o_fam" id="o_fam" value="'.$rukovoditel['second_name'].'" placeholder="фамилия руководителя Вашей организации"><br>';?>
			<label>Имя</label><br>
				<?php echo '<input type="text" name="o_name" id="o_name" value="'.$rukovoditel['first_name'].'" placeholder="имя руководителя Вашей организации"><br>';?>
			<label>Отчество</label><br>
				<?php echo '<input type="text" name="o_otch" id="o_otch" value="'.$rukovoditel['last_name'].'" placeholder="отчество руководителя Вашей организации* если есть"><br>';?>
			<button class="edit_but" onclick="updaterukovod()"><img src="../img/edit.png" width="16px" height="16px"></button>
			<button class="del_butt"><img src="../img/delete.png" width="16px" height="16px"></button>
		</div>
	</div>
</div>
