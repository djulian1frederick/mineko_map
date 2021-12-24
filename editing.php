<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery.tinyTips.js"></script>
<script type="text/javascript" src="../js/func_admin.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/select2.min.js"></script>
<link rel="stylesheet" href="../css/index.css">
		
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<?php require_once("connection.php");?>

</div>
<div class="container">
	<div class="blocks_info">
		<label for="">Название организации</label><br>
		<input type="text" required id="nameorg" name="nameorg"><br>
		<label for="">ИНН</label><br>
		<input type="text" required id="inn" name="inn"><br>
		<label for="">ОГРН</label><br>
		<input type="text" required id="ogrn" name="ogrn"><br>
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
			<input type="checkbox" id="checkbox1" onclick="toggle('checkbox1','viddeyadd','viddey')"><label for="checkbox1" class="checkbox_label">Нажмите, если в выпадаюем списке отсутствует необходимый вариант</label><br>
			<?php 
				$sql="select * from vid_deyat";
				$viddey_q=mysqli_query($bd, $sql);
				$viddey_list=mysqli_fetch_array($viddey_q);
				if ($viddey_list == NULL) {
					echo "<input type='text' name='viddeyadd' id='viddeyadd' style='display: none;'>";
				}
				else {
					echo "<input type='text' name='viddeyadd' id='viddeyadd' style='display: none;'>";
					echo '<select name="viddey" id="viddey" class="js-example-basic-single">';
					echo '<option value="">Не выбрано</option>';
					do {
						echo '<option value="'.$viddey_list['id_vid_deyat '].'">'.$viddey_list['vid_deyatelnosti'].'</option>';
					}while($viddey_list=mysqli_fetch_array($viddey_q));
				}
				echo '</select><br>';
			?>
			<label>Код продукции</label><br>
			
			<input type="checkbox"  id="checkbox2"  onclick="toggle('checkbox2','codeprodadd', 'codeprod')"><label for="checkbox2" class="checkbox_label">Нажмите, если в выпадаюем списке отсутствует необходимый вариант</label><br>
			<?php 
				$sql="select * from code_product";
				$code_q=mysqli_query($bd, $sql);
				$code_list=mysqli_fetch_array($code_q);
					if ($code_list == NULL){
						echo '<input type="text" id="codeprodadd" name="codeprodadd" style="display: none;">';
					}
					else {
						echo '<input type="text" id="codeprodadd" name="codeprodadd" style="display: none;">';
						echo '<select name="codeprod" id="codeprod" class="js-example-basic-single">';
						echo '<option value="">Не выбрано</option>';
					do {
						echo '<option value="'.$code_list['id_code_product '].'">'.$code_list['code'].': '.$code_list['name'].'</option>';
					}while($code_list=mysqli_fetch_array($code_q));
					echo '</select><br>';
				}
			?>

		<br>
		<label>Год начала экспортной деятельности</label><br>
		<input type="text" name="year" id="year"><br>
		<label>Код ТН ВЭД</label><br>
		<input type="text" name="codetnved" id="codetnved"><br>
		<button onclick="addorganization()">Добавить организацию</button>
	</div>

		<div class="blocks_info">
		<div><span>Добавление руководителя организации / надо добавить сюда обновление </span><br>
		<label>Фамилия</label><br>
		<input type="text" name="o_fam" id="o_fam"><br>
		<label>Имя</label><br>
		<input type="text" name="o_name" id="o_name"><br>
		<label>Отчество</label><br>
		<input type="text" name="o_otch" id="o_otch"><br>
		<select name="organization" id="o_raion" class="js-example-basic-single">
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
		<button onclick="addto()">Добавить</button><br>
		</div>


		<div class="blocks_info">
			<label>Полный адрес</label><br>
			<input name="address" onchange="getaddress()" type="text" value="" id="address" placeholder="Адрес"><br>
			<label>Номер здания</label><br>
			<input type="text" name="numberhouse" id="nubmerhouse"><br>
		</div>
</div>
</div>

