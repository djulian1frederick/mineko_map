<?php require_once('../connection.php'); ?>
	<?php
		$org = $_POST['org_ident'];
		$sql_select_main = "SELECT * from predpriyatiya where id_predpriyatiya='".$org."'";
		$sql_main = mysqli_query($bd, $sql_select_main);
		$main_row = mysqli_fetch_array($sql_main);
	?>
<div class="blocks_info" id="thisform">
	<div class="update-block">
		<div style="margin: 0 2.5%;">
			<form id="logo_site">
					<?php echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';?>
				<label>Логотип</label><br>
					<?php echo'<div class="reload_img"><img src="/'.$main_row['logo'].'" alt="" id="reload_img"></div><br>';?>
				<input type="file" name="file" id="file"><br>
				<br>
					<?php echo '<input type="text" name="site" value="'.$main_row['site'].'" placeholder="адрес сайта"><br>'; ?>
				<button class="edit_but" type="submit"><img src="../img/edit.png" width="16px" height="16px"></button>
			</form>
			<div id="result"></div>
		</div>
	</div>
</div>

<script>
	$('#logo_site').submit(function(e) {
        // создадим объект FormData и добавим в него данные из формы;
        // обратите внимание, передаем конструктору DOM-объект формы
        var formData = new FormData($('#logo_site')[0]); 
         $.ajax({
            url: '../editor/scripts/update_logo_site.php',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            complete: function(data) {
              //	var obj = JSON.parse(data);
              //	console.log();
            	 $('#reload_img').attr("src", data.responseText);
            }
        });
         e.preventDefault();
	});
</script>

<style>
	.reload_img {
		width: 250px;
		overflow: hidden;
	}
	#reload_img {
		width: 100%;
	}
</style>