<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
	<?php
		if($_POST['org_ident'] <> NULL) {
			$org = $_POST['org_ident'];
			$_SESSION['org_id_tmp_fac'] = $org;
		}
		elseif(isset($_SESSION['org_id_tmp_fac'])){
			$org = $_SESSION['org_id_tmp_fac'];
		}
		$sql_select_main = "SELECT * from proizvodstva where id_predpriyatiya='".$org."'";
		$sql_main = mysqli_query($bd, $sql_select_main);
		$main_row = mysqli_fetch_array($sql_main);
	?>
<div class="blocks_info" id="thisform">
	<div class="update-block">
		<div style="margin: 0 2.5%;">
			<?php 
				echo '<p class="additional">Производство</p>';
				echo '<div class="update-block" style="display: inline-flex;width: 100%;flex-flow: row;">';
				echo '<div style="background: #1c75bc2e; overflow: hidden;">';
							echo '<form method="POST" enctype="multipart/form-data" action="scripts/add_proizvodstva.php" target="frame_result">';
						 	echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';
							echo '<input type="file" name="file" style="margin: auto;text-align: center;padding: 2px 20%;border-bottom: 2px solid #fff;"><br>';
							echo '<button type="submit" onclick="reloadform()" style="border-radius: 0;">Добавить</button><br>';
					echo '<iframe name="frame_result" style="width: 100%; height: 40px;" borderless></iframe>';
					echo '</div>';
					if($main_row <> NULL){ 
						echo '<div style="display: flex; flex-wrap: wrap; width: fit-content; margin: auto;">';
						do { 
								echo '<form method="POST" enctype="multipart/form-data" action="scripts/update_proizvodstva.php" target="frame_result">';
							 	echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';
							 		echo'<div class="reload_img">
							 		<div style="height: 100px; width: 200px; overflow: hidden; background: #f3faff;padding: 10px 0;margin: 0 10px;">
							 			<img src="../../'.$main_row['img_proizv'].'" alt="Фотография производства" id="reload_img" style="width: 100%;"></div>';
									echo '<div style="background: #f3faff; padding: 0; width: 200px; height: 50px; margin: 0 10px; text-align:center">
										<button class="del_butt" type="submit" value="d" name="button" onclick="confirm_delete()" style="display: inline-block;border: 2px double red;">
												<img src="../img/delete.png" width="20px" height="20px">
									</button></div>';
									
							 		echo '</div><br><input type="hidden" value='.$main_row['id_proizvodstva'].'" name="id_proizvodstva">';
							 			
									echo '</form>';
						}while($main_row = mysqli_fetch_array($sql_main));
					echo '</div>';
					}
 			echo '</div>';
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
 function reloadform()	{ setTimeout(function(){$('#thisform').load('updating_organization/facilities.php');},1000);}
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

