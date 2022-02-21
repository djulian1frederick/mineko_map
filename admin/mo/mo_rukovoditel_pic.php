<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div class="blocks_info">
	<h3>Добавление Фотографии руководителю</h3>
	<form method="post" enctype="multipart/form-data" id="form_img" action="../add_image.php">
	<label for="rukid">Выберите руководителя МО</label><br>
	<select name="rukovoditel" id="rukid" class="js-example-basic-single" style="width: 450px;">
		<option value="">Не выбрано</option>
		<?php 
			$sql = "SELECT * from rukovoditeli join mo join raions where mo.id_rukovod=rukovoditeli.id_rukovoditel and mo.id_raion = raions.id_raion";
			$ruk_list_q = mysqli_query($bd, $sql);
			$ruk_list = mysqli_fetch_array($ruk_list_q);
			do {
				echo '<option value="'.$ruk_list['id_rukovoditel'].'">'.$ruk_list['second_name'].' '.$ruk_list['first_name'].' ('.$ruk_list['raion'].')</option>';
			}while ($ruk_list=mysqli_fetch_array($ruk_list_q));
		?>
	</select><br>
	<label>Фото</label><br>
	<input type="file" name="file" id="r_file"><br>
	<input type="submit" value="Прикрепить">
	</form>
</div>