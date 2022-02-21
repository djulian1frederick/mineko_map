<?php require_once('../connection.php'); ?>
<?php 
		$org = $_POST['org_ident'];
		$sql_select_main = "SELECT id_con_people from predpriyatiya where id_predpriyatiya='".$org."'";
		$sql_main = mysqli_query($bd, $sql_select_main);
		$main_row = mysqli_fetch_array($sql_main);
		$id_con_people = $main_row['id_con_people'];
		$sql_main=mysqli_query($bd, "SELECT id_contact from contacts_people where id_con_people ='".$id_con_people."'");
		$main_row = mysqli_fetch_array($sql_main);
?>
<div class="blocks_info">
	<div style="margin: 0 2.5%;">
		<blockquote>В этом блоке указываются данные контактного лица организации</blockquote>
		<div class="update-block">
					<?php 
						$contact_select = "SELECT * from contacts where id_contact='".$main_row['id_contact']."'";
						$contact_sql = mysqli_query($bd, $contact_select);
						$contacts = mysqli_fetch_array($contact_sql);
					?>
				<?php echo '<input type="hidden" name="con_id" id="con_id" value="'.$contacts['id_contact'].'">';?>
				<?php echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';?>
			<label>Номер телефона</label><br>
				<?php echo '<input type="text" name="org_phone1" id="org_phone1" maxlength="12" value="'.$contacts['phone1'].'"><br>';?>
			<label>Адрес электронной почты</label><br>
				<?php echo '<input type="email" name="org_email" id="org_email" value="'.$contacts['email'].'"><br>';?>
			<button class="edit_but" onclick="updatecontact()"><img src="../img/edit.png" width="16px" height="16px"></button>
			<button class="del_butt"><img src="../img/delete.png" width="16px" height="16px"></button>
		</div>
	</div>
</div>