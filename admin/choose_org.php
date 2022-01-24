
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<?php require_once("connection.php");?>
<?php 
	$org = $_POST['org'];

	$sql_select_main = "SELECT * from predpriyatiya where id_predpriyatiya='".$org."'";
	$sql_main = mysqli_query($bd, $sql_select_main);
	$main_row = mysqli_fetch_array($sql_main);

?>

<div class="blocks_info" style="display: flex; flex-flow: row; flex-wrap: wrap; width: 80%; margin: 0 10%;">
	<div id="updateinfo" style="width: 50%;margin: 0 25%;text-align: center;"></div>
		<div style="width: 50%;">
		<div style="margin: 2.5%;background: white; border: 1px #dcdcdc solid;">
			<div style="margin: 0 2.5%;">
				<label for="">Название организации</label><br>
					<?php echo "<input type='text' required id='nameorg' name='nameorg' value='".$main_row['name']."'><input type='hidden' name='org_id' value='".$org."'><br>"; ?>
				<label for="">Описание</label><br>
					<?php echo '<textarea name="descr_organization" id="descr_organization" cols="68" row="5" value="'.$main_row['descr_organization'].'">'.$main_row['descr_organization'].'</textarea><br>'; ?>
				<label for="">ИНН</label><br>
					<?php echo '<input type="text" required id="inn" name="inn" value="'.$main_row['inn'].'"><br>'; ?>
				<label for="">ОГРН</label><br>
					<?php echo '<input type="text" required id="ogrn" name="ogrn" value="'.$main_row['ogrn'].'"><br>'; ?>
				<label>Размер предприятия</label><br>
				<?php 
					$sql="select * from size_predpr";
					$size_q=mysqli_query($bd, $sql);
					$sizes_list=mysqli_fetch_array($size_q);

					echo '<select name="sizepr" id="sizepr" class="js-example-basic-single" style="width: 50%;" >';
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
				<label for="checkbox1" class="checkbox_label">Нажмите, если в выпадающем списке отсутствует необходимый вариант</label><br>
				<?php 
					$sql="select * from vid_deyat";
					$viddey_q=mysqli_query($bd, $sql);
					$viddey_list=mysqli_fetch_array($viddey_q);
					if ($viddey_list == NULL) {
						echo "<input type='text' name='viddeyadd' id='viddeyadd' style='display: none;'>";
					}
					else {
						
						echo "<input type='text' name='viddeyadd' id='viddeyadd' style='display: none;'>";
						echo '<select name="viddey" id="viddey" class="js-example-basic-single" style="width: 50%;" >';
							
						do {
							if($viddey_list['id_vid_deyat'] == $main_row['id_vid_deyat']){ 
									$vid_dey = $viddey_list['vid_deyatelnosti'];
									echo "<option value='".$main_row['id_vid_deyat']."'>Текущий: ".$vid_dey."</option>";
								}
							else {echo '<option value="'.$viddey_list['id_vid_deyat'].'">'.$viddey_list['vid_deyatelnosti'].'</option>';}
						}while($viddey_list=mysqli_fetch_array($viddey_q));
					echo '</select><br>';
				}
					
				?>
				<label>Код продукции</label><br>
				
				<input type="checkbox"  id="checkbox2"  onclick="toggle('checkbox2','codeprodadd', 'codeprod')">
				<label for="checkbox2" class="checkbox_label">Нажмите, если в выпадаюем списке отсутствует необходимый вариант</label><br>
				<?php 
					$sql="select * from code_product order by code";
					$code_q=mysqli_query($bd, $sql);
					$code_list=mysqli_fetch_array($code_q);
						if ($code_list == NULL){
							echo '<input type="text" id="codeprodadd" name="codeprodadd" style="display: none;">';
						}
						else {
							
							echo '<input type="text" id="codeprodadd" name="codeprodadd" style="display: none;">';
							echo '<select name="codeprod" id="codeprod" class="js-example-basic-single" style="width: 50%;" >';
								
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
				<?php echo '<input type="text" name="year" value="'.$main_row['yearstart'].'" id="year"><br>';?>
			<label>Код ТН ВЭД</label><br>
				<?php echo '<input type="text" name="codetnved" id="codetnved" value="'.$main_row['code_tn_ved'].'"><br>';?>
				<button class="edit_but" onclick="editmaininfo()"><img src="../img/edit.png" width="16px" height="16px"></button>
		</div>
	</div>
		<div style="margin: 0 2.5%;">
			<?php 
					$select_production = "SELECT * from production where id_predpriyatia='".$org."'";
						$production = mysqli_query($bd, $select_production);
						$production_row = mysqli_fetch_array($production);
					if ($production_row <> NULL) {
					echo'<div><ul style="display: inline-flex; flex-flow: row; flex-wrap: wrap; background: white;  padding: 15px;"><h5 style="text-align: center;margin: 0 auto;font-size: 16px;  padding-bottom: 10px;">Продукция</h5>';
						do {
							echo '<li style="border: 1px solid #dcdcdc; width: 100%;">
							<form id="production_form" method="POST" enctype="multipart/form-data" action="scripts/update_upload.php" target="_blank">
							<input type="hidden" name="org_id" id="org_id" value="'.$org.'">
							<img  style="float: left;" width="150px" src="../'.$production_row['image_href'].'" alt="'.$production_row['name_production'].'" title="'.$production_row['name_production'].'">
								<input type="hidden" name="prodid" id="prodid" value="'.$production_row['id_product'].'">
							<input type="text" name="production_name" id="production_name" value="'.$production_row['name_production'].'" style="margin: 0 5%; margin: 5%; border: none; border-bottom: 1px solid; font-style: italic; word-break: break-word;    padding: 5px;"><br>';
								
								echo "<textarea cols='40' rows='3' name='descr' id='descr' value='".$production_row['description']."'>".$production_row['description']."</textarea>";

							echo '<input type="file" name="file" id="file" style="margin: 0 5%;background: #1c75bc;padding: 5px;color: white; border: none;">
							
							<button class="edit_but" type="submit"><img src="../img/edit.png" width="16px" height="16px"></button><button class="del_butt"><img src="../img/delete.png" width="16px" height="16px"></button>
							</form>
							</li>';
						} while ($production_row = mysqli_fetch_array($production));
				echo '</ul></div>';	}
					 ?>
		</div>
	</div>
		<div style="width: 40%;">
			<div style="margin: 2.5%;background: white; border: 1px #dcdcdc solid;">
				<div style="margin: 0 2.5%;">
						<label>Экспортный рынок</label>
						<?php
							$export_select = "SELECT * from country join exports where exports.id_country=country.id_country and exports.id_predpriyatiya='".$org."'";
							$export_sql = mysqli_query($bd, $export_select);
							$export_r = mysqli_fetch_array($export_sql);
								if ($export_r <> NULL) {
									echo '<h5 style="margin: 0; padding: 0; font-style: italic;">Текущие</h5><ul class="export_list">';

									do {echo '
											
												
												<li>'.$export_r['name_country'].'</li>';
									}while ($export_r=mysqli_fetch_array($export_sql));
								echo '</ul>';
								}
						?>
						<select name="exports" class="js-example-basic-single"style="width: 50%;" id="exports">
						<?php
							$export_select = "SELECT * from country";
							$export_sql = mysqli_query($bd, $export_select);
							$export_row = mysqli_fetch_array($export_sql); 
							do {
			 					echo "<option value='".$export_row['id_country']."'>".$export_row['name_country']."</option>";
							}while($export_row = mysqli_fetch_array($export_sql));
						?>
						</select>
						<?php echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';?>
					<button class="edit_but" onclick="editexports()"><img src="../img/edit.png" width="16px" height="16px"></button>
					<button class="del_butt"><img src="../img/delete.png" width="16px" height="16px"></button>
			</div>
		</div>
		<div style="margin: 2.5%;background: white; border: 1px #dcdcdc solid;">
			<div style="margin: 0 2.5%;">
			<h5>Руководитель</h5>
			
			<?php
				$rukovoditel_select = "SELECT * from rukovoditeli where id_rukovoditel = '".$main_row['id_rukovoditel']."'";
				$rukovoditel_sql = mysqli_query($bd, $rukovoditel_select);
				$rukovoditel = mysqli_fetch_array($rukovoditel_sql); 
			?>
				<?php echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';?>
					<?php echo '<input type="hidden" name="ruk_id" id="ruk_id" value="'.$rukovoditel['id_rukovoditel'].'">';?>
				<label>Фамилия</label><br>
					<?php echo '<input type="text" name="o_fam" id="o_fam" value="'.$rukovoditel['second_name'].'"><br>';?>
				<label>Имя</label><br>
					<?php echo '<input type="text" name="o_name" id="o_name" value="'.$rukovoditel['first_name'].'"><br>';?>
				<label>Отчество</label><br>
					<?php echo '<input type="text" name="o_otch" id="o_otch" value="'.$rukovoditel['last_name'].'"><br>';?>
		<button class="edit_but" onclick="updaterukovod()"><img src="../img/edit.png" width="16px" height="16px"></button>
		<button class="del_butt"><img src="../img/delete.png" width="16px" height="16px"></button>
			</div>
		</div>
			<div style="margin: 2.5%;background: white; border: 1px #dcdcdc solid;">
				<div style="margin: 0 2.5%;">
				<h5>Контакты</h5>
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
			<div style="margin: 2.5%;background: white; border: 1px #dcdcdc solid;">
				<div style="margin: 0 2.5%;">
					<form id="logo_site">
						<?php echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';?>
						<label>Логотип</label><br>
						<?php echo'<img src="/'.$main_row['logo'].'" alt=""><br>';?>
						<input type="file" name="file" id="file"><br>
						<br>
						<?php echo '<input type="text" name="site" value="'.$main_row['site'].'" placeholder="адрес сайта"><br>'; ?>
						<button class="edit_but" type="submit"><img src="../img/edit.png" width="16px" height="16px"></button>
						<button class="del_butt"><img src="../img/delete.png" width="16px" height="16px"></button>
					</form>
				</div>	
			</div>
			<div>
				<?php echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';?>
				<textarea name="name_service" id="name_service" cols="80" rows="10"></textarea>
				<button class="edit_but" onclick="editexportservice()"><img src="../img/edit.png" width="16px" height="16px"></button>
			</div>
		</div>
	</div>


<script>
	$('#logo_site').submit(function(e) {
        // создадим объект FormData и добавим в него данные из формы;
        // обратите внимание, передаем конструктору DOM-объект формы
        var formData = new FormData($('#logo_site')[0]); 
         $.ajax({
            url: '../admin/scripts/update_logo_site.php',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
	              
            }
        });
         e.preventDefault();
	
});
</script>