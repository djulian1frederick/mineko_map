<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div class="blocks_info" id="">
	<h3>Добавление Фотографии руководителю</h3>
	<form method="post" enctype="multipart/form-data" id="form_img" action="/editor/scripts/add_image.php" target="result_add" style="width: 500px; margin: 0; padding: 10px 0; background: azure;">
	<div style="margin: 10px 0;">
		<label for="rukid">Выберите руководителя МО</label><br>
		<select name="rukovoditel" id="rukid" class="js-example-basic-single" style="width: 450px;">
			<option value="">Не выбрано</option>
			<?php 
				require_once('../connection.php');
				$sql = "SELECT * from rukovoditeli join mo join raions where mo.id_rukovod=rukovoditeli.id_rukovoditel and mo.id_raion = raions.id_raion";
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