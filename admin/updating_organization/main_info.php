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
			<label for="">Название организации</label><br>
				<?php echo "<input type='text' required id='nameorg' name='nameorg' value='".$main_row['name']."'><input type='hidden' id='org_id' name='org_id' value='".$org."'><br>"; ?>
			<label for="">Описание</label><br>
				<?php 
				if($main_row['descr_organization'] == NULL) {
					$placeholder = 'placeholder="здесь могло быть описание Вашей организации"';
				}
				echo '<textarea name="descr_organization" id="descr_organization" cols="68" row="5" style="width: 450px;" value="'.$main_row['descr_organization'].'" '.$placeholder.'>'.$main_row['descr_organization'].'</textarea><br>'; ?>
			<label for="">ИНН</label><br>
				<?php echo '<input type="text" pattern="\d*" required id="inn" name="inn" maxlength="10" value="'.$main_row['inn'].'"><br>'; ?>
			<label for="">ОГРН</label><br>
				<?php 
				if($main_row['ogrm'] == NULL) {$placeholder_ogrn = 'placeholder="здесь мог быть указан ОГРН Вашей организации"';}
				echo '<input type="text" pattern="\d*" required id="ogrn" name="ogrn" maxlength="15" value="'.$main_row['ogrn'].'" '.$placeholder_ogrn.'><br>'; ?>
			<label>Размер предприятия</label><br>
				<?php 
						$sql="select * from size_predpr";
						$size_q=mysqli_query($bd, $sql);
						$sizes_list=mysqli_fetch_array($size_q);

						echo '<select name="sizepr" id="sizepr" class="js-example-basic-single" style="width: 450px; max-width: 100%;">';
							do {
								if ($sizes_list['id_size'] == $main_row['id_size']) { 
											$size_name = $sizes_list['name_size']; 
											echo '<option value="'.$main_row['id_size'].'">Текущий: '.$size_name.'</option>';
								}
								else {echo '<option value="'.$sizes_list['id_size'].'">'.$sizes_list['name_size'].'</option>';}
								}while($sizes_list=mysqli_fetch_array($size_q));
							echo '</select><br>';
				?>	
			<label>Вид деятельности</label><br>			
				<input type="checkbox" id="checkbox1" onclick="toggle('checkbox1','viddeyadd','viddey')">
			<label for="checkbox1" class="checkbox_label">Нажмите, если в списке отсутствует необходимый вариант</label><br>
				<?php 
					$sql="select * from vid_deyat";
					$viddey_q=mysqli_query($bd, $sql);
					$viddey_list=mysqli_fetch_array($viddey_q);
						if ($viddey_list == NULL) {
							echo "<input type='text' name='viddeyadd' id='viddeyadd' maxlength='150' style='display: none;'>";
						}
						else {
								echo "<input type='text' name='viddeyadd' id='viddeyadd' style='display: none;'>";
								echo '<select name="viddey" id="viddey" class="js-example-basic-single" style="width: 450px; max-width: 100%;" >';
									do {
										if($viddey_list['id_vid_deyat'] == $main_row['id_vid_deyat']){ 
											$vid_dey = $viddey_list['vid_deyatelnosti'];
											echo "<option value='".$main_row['id_vid_deyat']."'>Текущий: ".$vid_dey."</option>";
										}
										else 
											{echo '<option value="'.$viddey_list['id_vid_deyat'].'">'.$viddey_list['vid_deyatelnosti'].'</option>';}
									}while($viddey_list=mysqli_fetch_array($viddey_q));
								echo '</select><br>';
						}
				?>
			<label>Код продукции</label><br>		
				<input type="checkbox"  id="checkbox2"  onclick="toggle('checkbox2','codeprodadd', 'codeprod')">
			<label for="checkbox2" class="checkbox_label">Нажмите, если в списке отсутствует необходимый вариант</label><br>
				<?php 
					$sql="select * from code_product order by code";
					$code_q=mysqli_query($bd, $sql);
					$code_list=mysqli_fetch_array($code_q);
						if ($code_list == NULL){
							echo '<input type="text" id="codeprodadd" name="codeprodadd" maxlength="150" style="display: none;">';
						}
						else {		
							echo '<input type="text" id="codeprodadd" name="codeprodadd" style="display: none;">';
							echo '<select name="codeprod" id="codeprod" class="js-example-basic-single" style="width: 450px; max-width: 100%;" >';
								do {
									if($code_list['id_code_product'] == $main_row['id_code_product']){
										$code = $code_list['code']; 
										echo '<option value="'.$main_row['id_code_product'].'">Текущий:'.$code_list['code'].'</option>';
									}
									else {
										echo '<option value="'.$code_list['id_code_product'].'">'.$code_list['code'].'</option>';}
								}while($code_list=mysqli_fetch_array($code_q));
							echo '</select><br>';
						}
				?>
			<label>Год начала экспортной деятельности</label><br>
				<?php 
				if($main_row['yearstart'] == NULL) {
					$placeholder_year = 'placeholder="здесь может быть указан год начала экспорта Вашей организации"';
				}
				echo '<input type="text" pattern="\d*" name="year" maxlength="4" minlength="4" value="'.$main_row['yearstart'].'" id="year" '.$placeholder_year.'><br>';?>
			<button class="edit_but" onclick="editmaininfo()"><img src="../img/edit.png" width="16px" height="16px"></button>
		</div>
	</div>
</div>


