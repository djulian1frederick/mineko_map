<?php session_start(); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div class="blocks_info">
	<h3 style="margin-top: 20px;">Добавление Фотографии руководителю</h3>
	<form method="post" enctype="multipart/form-data" id="form_img" action="/editor/scripts/add_image.php" target="result_add" style="width: 100%; margin: 0; padding: 10px 0; background: #fff;">
	<div style="margin: 10px 0;">
		<label for="rukid">Выберите руководителя МО</label><br>
		<select name="rukovoditel" id="rukid" class="js-example-basic-single" style="width: 450px; max-width: 100%;">
			<option value="">Не выбрано</option>
			<?php 
				require_once('../connection.php');
				if($_SESSION['level'] <> '2') {
				$sql = "SELECT * from rukovoditeli join mo join raions where mo.id_rukovod=rukovoditeli.id_rukovoditel and mo.id_raion = raions.id_raion";}
				elseif($_SESSION['level'] == '2') {
					$admin_id = mysqli_query($bd, "SELECT id_admin from admins where id_user='".$_SESSION['user_id']."'");
						$admin_id = mysqli_fetch_array($admin_id);
						$admin_id = $admin_id['id_admin'];
						$id_mo = mysqli_query($bd, "SELECT id_mo from mo where id_admin='".$admin_id."'");
						$id_mo = mysqli_fetch_array($id_mo);
						$id_mo = $id_mo['id_mo'];
						$sql = "SELECT * from rukovoditeli join mo join raions where mo.id_rukovod=rukovoditeli.id_rukovoditel and mo.id_raion = raions.id_raion and mo.id_mo='".$id_mo."'";
				}
				$ruk_list_q = mysqli_query($bd, $sql);
				$ruk_list = mysqli_fetch_array($ruk_list_q);
				do {
					echo '<option value="'.$ruk_list['id_rukovoditel'].'">'.$ruk_list['second_name'].' '.$ruk_list['first_name'].' ('.$ruk_list['raion'].')</option>';
				}while ($ruk_list=mysqli_fetch_array($ruk_list_q));
			?>
		</select><br>
		<label>Фото</label><br>
		<div style="">
			<input type="file" name="file" id="r_file" style="width: 325px">
			<input type="submit" value="Прикрепить">
		</div>
		<div style="border-top: 2px solid;">Размер изображения не должен превышать 1мб</div>
	</div>
	</form>
	<iframe name="result_add" borderless style="height: 40px;"></iframe>
</div>