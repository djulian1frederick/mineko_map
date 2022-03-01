<?php require_once('../connection.php'); ?>
	<?php
		$org = $_POST['org_ident'];
		$sql_select_main = "SELECT * from proizvodstva where id_predpriyatiya='".$org."'";
		$sql_main = mysqli_query($bd, $sql_select_main);
		$main_row = mysqli_fetch_array($sql_main);
	?>
<div class="blocks_info" id="thisform">
	<div class="update-block">
		<div style="margin: 0 2.5%;">
			<?php 
				echo '<label>Производство</label><br>';
					if($main_row <> NULL){ 
						do { 
								echo '<form method="POST" enctype="multipart/form-data" action="scripts/update_proizvodstva.php" target="">';
							 	echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';
							 		echo'<div class="reload_img">
							 		<img src="/'.$main_row['img_proizv'].'" alt="Фотография производства" id="reload_img">';
									echo '<div><button class="del_butt" type="submit" value="d" name="button" onclick="confirm_delete()" style="margin-top: -45px;margin-left: -5px;border: 2px double red;">
												<img src="../img/delete.png" width="20px" height="20px">
									</button></div>';
									echo '<div style="display: flex; width: auto; padding: 0; margin: -5px;"><input type="file" name="updatefile"><br>';
									echo '<button class="edit_but" type="submit" value="e" name="button" style="margin: -5px 0; padding: 5px; border: 2px solid #1576bd;">
												<img src="../img/edit.png" width="16px" height="16px"></button></div>';
							 		echo '</div><br><input type="hidden" value='.$main_row['id_proizvodstva'].'" name="id_proizvodstva">';
							 			
									echo '</form>';
						}while($main_row = mysqli_fetch_array($sql_main));
					}
					else {
							echo '<form method="POST" enctype="multipart/form-data" action="scripts/add_proizvodstva.php" target="">';
						 	echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';
							echo '<input type="file" name="updatefile"><br>';
							echo '<button type="submit"><img src="../img/plus.png" width="16px" height="16px">Добавить</button><br>';
					}
				
 			?>
		</div>
	</div>
</div>

<script>
function confirm_delete() {
 			if(confirm('Вы уверены в удалении ЭТОЙ фотографии производства?'))
 			{
 				reloadform();
 			}
 }
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

