<?php require_once("../connection.php"); ?>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div id="result"></div>
<div class="blocks_info">
	<h3>Добавление организаций</h3>
		<label for="">Название организации*</label><br>
		<input type="text" required id="nameorg" name="nameorg" placeholder="Введите название организации" required><br>
		<label for="">ИНН*</label><br>
		<input type="number" required id="inn" name="inn" maxlength="10" placeholder="Введите ИНН" required><br>
		<label for="">ОГРН*</label><br>
		<input type="number" required id="ogrn" name="ogrn" maxlength="15" placeholder="Введите ОГРН" required><br>
		<label>Размер предприятия</label><br>
			<?php 
				$sql="select * from size_predpr";
				$size_q=mysqli_query($bd, $sql);
				$sizes_list=mysqli_fetch_array($size_q);
				if ($sizes_list == NULL ){ 
					echo '<input type="text" name="sizepr_add" id="sizepradd">';
				}
				else {
					echo '<select name="sizepr" id="sizepr" class="js-example-basic-single">';
					echo '<option value="">Не выбрано</option>';
					do {
						echo '<option value="'.$sizes_list['id_size'].'">'.$sizes_list['name_size'].'</option>';
					}while($sizes_list=mysqli_fetch_array($size_q));
					echo '</select><br>';
				}
		
			?>
		
			<label>Вид деятельности</label><br>			
			<input type="checkbox" id="checkbox1" onclick="toggle('checkbox1','viddeyadd','viddey')"><label for="checkbox1" class="checkbox_label">Нажмите, если в списке отсутствует необходимый вариант</label><br>
			<?php 
				$sql="select * from vid_deyat";
				$viddey_q=mysqli_query($bd, $sql);
				$viddey_list=mysqli_fetch_array($viddey_q);
				if ($viddey_list == NULL) {
					echo "<input type='text' name='viddeyadd' id='viddeyadd' style='display: none;'>";
				}
				else {
					echo "<input type='text' name='viddeyadd' id='viddeyadd' style='display: none;'>";
					echo '<select name="viddey" id="viddey" class="js-example-basic-single" style="width: 450px;">';
					echo '<option value="">Не выбрано</option>';
					do {
						echo '<option value="'.$viddey_list['id_vid_deyat'].'">'.$viddey_list['vid_deyatelnosti'].'</option>';
					}while($viddey_list=mysqli_fetch_array($viddey_q));
				}
				echo '</select><br>';
			?>
			<label>Код продукции</label><br>
			
			<input type="checkbox"  id="checkbox2"  onclick="toggle('checkbox2','codeprodadd', 'codeprod')"><label for="checkbox2" class="checkbox_label">Нажмите, если в списке отсутствует необходимый вариант</label><br>
			<?php 
				$sql="select * from code_product order by code";
				$code_q=mysqli_query($bd, $sql);
				$code_list=mysqli_fetch_array($code_q);
					if ($code_list == NULL){
						echo '<input type="text" id="codeprodadd" name="codeprodadd" style="display: none;">';
					}
					else {
						echo '<input type="text" id="codeprodadd" name="codeprodadd" style="display: none;">';
						echo '<select name="codeprod" id="codeprod" class="js-example-basic-single" style="width: 450px;">';
						echo '<option value="">Не выбрано</option>';
					do {
						echo '<option value="'.$code_list['id_code_product'].'">'.$code_list['code'].'</option>';

					}while($code_list=mysqli_fetch_array($code_q));
					echo '</select><br>';
				}
			?>

		<br>
		<label>Год начала экспортной деятельности</label><br>
		<input type="number" name="year" id="year" placeholder="Введите год"><br>
		<p style="margin: 5px 0; padding: 2px; border-top: 3px solid #000; font-family: Circe; width: 450px; color: #1c75bc; font-weight: bold;">* - Обязательное поле</p>
		<button onclick="addorganization()" type="submit" class="add_but"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
</div>