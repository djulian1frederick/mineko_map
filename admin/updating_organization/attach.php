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