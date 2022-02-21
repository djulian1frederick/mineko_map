<form id="add_production">
			<?php $org=$_POST['org']; ?>
			<?php echo 	'<input type="hidden" name="organization" id="organization" value="'.$org.'">';?>
				<label for="alt_name">Название продукции</label><br>
				<input type="text" name="alt_name" id="alt_name" placeholder="Введите название продукции" required>
				<br><br>
				<label for="file">Выберите изображение для продукции продукции</label><br>
				<input type="file" name="file" id="js-file" accept="image/*"><br><br>
				<label for="codetnved">КОД ТН ВЭД</label><br>
				<input type="text" name="codetnved" id="codetnved" placeholder="Введите КОД ТН ВЭД" required>
				<br>
				<label for="codetnved_descr">Описание КОДа ТН ВЭД</label><br>
				<textarea name="codetnved_descr" id="codetnved_descr" placeholder="Описание кода"></textarea>
				<br>
				<button type="submit"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
</form>
<div id="result">
	
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
            success: function(data) {
	              $('#result').html(data);
            }
        });
         e.preventDefault();
	
});
</script>