<script src="../js/select2.min.js"></script>
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
		echo '<input type="hidden" id="org" value="'.$org.'">';
	?>
<div class="blocks_info">
	<div id="result">
		
	</div>
	<?php 
		$code_tn= mysqli_query($bd, "SELECT * from code_tn_veds where id_predpriyatiya='".$org."'");
	 	$code_tn_row = mysqli_fetch_array($code_tn);
	 	if ($code_tn_row <> NULL) {
	 		echo '<p class="additional">КОДы ТН ВЭД ЕАЭС</p>
		 				<div class="update-block" style="display: flex; flex-flow: wrap;">';
	 		do {
	 				echo '<div class="fit-blocks">
	 						<div>
		 						<button class="edit_but" onclick="updatetnved()" style="margin-left: 7.5px;">
								<img src="../img/edit.png" width="20px" height="20px">
							  	</button>
								<button class="del_butt" onclick=deletetnved() style="margin-left: 7.5px;">
								<img src="../img/delete.png" width="20px" height="20px">
						  		</button>
						  	</div>';
						echo '<input type="hidden" id="idcode" value="'.$code_tn_row['id_code_tn_ved'].'">';
	 					echo '<input type="text" id="codetnnved" value="'.$code_tn_row['code_tn_ved'].'"><br>';
	 					echo '<textarea id="codetnved_descr" value="'.$code_tn_row['description_code'].'" style="height: 50px;">'.$code_tn_row['description_code'].'</textarea></div>';
	 		}while ($code_tn_row=mysqli_fetch_array($code_tn));
	 		echo '</div>';
	 	}
	 ?> 

	<?php 
		$select_production = "SELECT * from production where id_predpriyatiya='".$org."'";
		$production = mysqli_query($bd, $select_production);
		$production_row = mysqli_fetch_array($production);
			if ($production_row <> NULL) {
				

				echo'<p class="additional">Продукция</p>
						<div class="update-block">
						<ul style="display: flex; flex-flow: row; flex-wrap: wrap; background: white;  padding: 15px;">';
					do {
						echo '<li style="border: 1px solid #dcdcdc; width: 100%;">
								<form id="production_form" method="POST" enctype="multipart/form-data" action="scripts/update_upload.php" target="_blank">
									<input type="hidden" name="org_id" id="org_id" value="'.$org.'">
									<input type="file" name="file" id="file" style="margin: 0 75px;background: #1c75bc;padding: 5px;color: white; border: none;">
									<img  style="float: left;border: 1px solid #cecece;" width="150px" src="../'.$production_row['image_href'].'" alt="'.$production_row['name_production'].'" title="'.$production_row['name_production'].'">';
								echo '<div><input type="hidden" name="prodid" id="prodid" value="'.$production_row['id_product'].'">
									<input type="text" name="production_name" id="production_name" value="'.$production_row['name_production'].'" style="margin: 20px 75px; border: none; border-bottom: 1px solid; font-style: italic; word-break: break-word;    padding: 5px;"><br>';
								echo "<textarea cols='40' rows='3' style='margin:0 75px; height: 60px;' name='descr' id='descr' value='".$production_row['description']."'>".$production_row['description']."</textarea>";
								$code_tn= mysqli_query($bd, "SELECT * from code_tn_veds where id_predpriyatiya='".$org."'");
									$code_tn_row = mysqli_fetch_array($code_tn);
									if ($code_tn_row <> NULL) {
										echo '<div>';
										echo '<label>КОД ТН ВЭД продукции</label><br>';
										echo '<select name="codetnved_id" class="js-example-basic-single" style="width: 450px;">';
			 								echo '<option value="">Не выбрано</option>';
			 								do {
			 									echo '<option value="'.$code_tn_row['id_code_tn_ved'].'">'.$code_tn_row['code_tn_ved'].'</option>';
											}while ($code_tn_row=mysqli_fetch_array($code_tn));
									echo '</select>';
									echo '</div>';
									}
								echo '</div><div style="margin-top: -20px; float: left"><button class="edit_but" type="submit" style="margin-left: 7.5px;">
										<img src="../img/edit.png" width="20px" height="20px">
									</button>
									<button class="del_butt" style="margin-left: 7.5px;">
										<img src="../img/delete.png" width="20px" height="20px">
									</button></div>
								</form>
							</li>';
					} while ($production_row = mysqli_fetch_array($production));
				echo '</ul></div>';	}
				echo '<p class="additional" onclick="openblock_add()">Добавить продукцию</p>';
				echo '<div id="adding-production"></div>';
	?>
</div>
<script>
	function openblock_add() {
		var org = $('#org').val();
      $.ajax({
           type: "POST",
           url: 'updating_organization/add_production.php',
           dataType: 'text',
           data: {"org" : org},
           success:function(html) {
             $('#adding-production').html(html);
           }

      });
 }	
</script>

