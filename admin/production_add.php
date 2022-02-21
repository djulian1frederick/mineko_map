<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/func_admin.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/admin_files.js"></script>
<link rel="stylesheet" href="../css/index.css">
<?php include('header.php');?>	
		
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<?php require_once("connection.php");?>

<div class="container">
	<div class="content">
		<div class="blocks_info">
			<form id="upload_production">
			<label for="organization">Выберите организацию</label><br>
			<select name="organization" id="organization" class="js-example-basic-single" style="width: 450px;">
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
				<label for="alt_name">Название продукции</label><br>
				<input type="text" name="alt_name" id="alt_name" placeholder="Введите название продукции" required>
				<br>
				<input type="file" name="file" id="js-file" accept="image/*">
				<button type="submit"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
			</form>
		</div>
	</div>
</div>
<div class="container">
	<div class="content">
		<div class="blocks_info">
			<label for="organization">Выберите организацию</label><br>
			<select name="orgid" id="orgid" class="js-example-basic-single" style="width: 450px;">
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
				<label for="codetnved">КОД ТН ВЭД</label><br>
				<input type="text" name="codetnved" id="codetnved" placeholder="Введите КОД ТН ВЭД" required>
				<br>
				<label for="codetnved_descr">Описание КОДа ТН ВЭД</label><br>
				<textarea name="codetnved_descr" id="codetnved_descr" placeholder="Описание кода"></textarea>
				<br>
				<button onclick="addcodetn()"><img src="../img/plus.png" width="16px" height="16px"> Добавить</button><br>
		</div>
	</div>
</div>
<div id="result">
	
</div>
 
<script>
	$('#upload_production').submit(function(e) {
        // создадим объект FormData и добавим в него данные из формы;
        // обратите внимание, передаем конструктору DOM-объект формы
        var formData = new FormData($('#upload_production')[0]); 
         $.ajax({
            url: 'upload.php',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
	              $('#alt_name').val("");
            }
        });
         e.preventDefault();
	
});
</script>
