<form id="add_production">
			<?php $org=$_POST['org']; ?>
			<?php echo 	'<input type="hidden" name="organization" id="organization" value="'.$org.'">';?>
				<label for="alt_name">Название продукции</label><br>
				<input type="text" name="alt_name" id="alt_name" placeholder="Введите название продукции" required>
				<br><br>
				<label for="file">Выберите изображение для продукции продукции</label><br>
				<input type="file" name="file" id="js-file" accept="image/*"><br><br>
				<div id="code_new">
				<label for="codetnved">КОД ТН ВЭД</label><br>
				<input type="number" name="codetnved" id="codetnved" maxlength="14" placeholder="Введите КОД ТН ВЭД">
				<br>
				<label for="codetnved_descr">Описание КОДа ТН ВЭД</label><br>
				<textarea name="codetnved_descr" id="codetnved_descr" placeholder="Описание кода"></textarea>
				</div>
				<br>		
				<input type="checkbox" id="checkbox1" onclick="toggle('checkbox1','exists_code','code_new')">
				<label for="checkbox1" class="checkbox_label">Нажмите, чтобы появился список</label><br>
				<div id="exists_code">
				<?php 
					require_once('../connection.php');
					$current_code =mysqli_query($bd, "SELECT id_code_tn_ved, code_tn_ved from code_tn_veds");
					$code_tn_row = mysqli_fetch_array($current_code);
					echo '<select name="codetnved_id" class="js-example-basic-single" style="width: 450px; display: none;">';
						do {
			 				echo '<option value="'.$code_tn_row['id_code_tn_ved'].'">'.$code_tn_row['code_tn_ved'].'</option>';
						}while ($code_tn_row=mysqli_fetch_array($current_code));
				?>	
				</div>
				<button type="submit"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
</form>
<div id="result_production">
	
</div>
<script>
	$('#add_production').submit(function(e) {
        // создадим объект FormData и добавим в него данные из формы;
        // обратите внимание, передаем конструктору DOM-объект формы
        var formData = new FormData($('#add_production')[0]); 
         $.ajax({
            url: 'scripts/add_production.php',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            complete: function(data) {
	              $('#result_production').html(data);
            }
        });
         e.preventDefault();
	
});
</script>

<script src="../js/select2.min.js"></script>
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>