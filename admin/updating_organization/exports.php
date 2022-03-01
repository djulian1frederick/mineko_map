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
<div class="blocks_info" id="exports-block">
	<div class="update-block">
	<div style="margin: 0 2.5%;">
		<p>Экспортный рынок</label>
			<?php
				$export_select = "SELECT * from country join exports where exports.id_country=country.id_country and exports.id_predpriyatiya='".$org."'";
				$export_sql = mysqli_query($bd, $export_select);
				$export_r = mysqli_fetch_array($export_sql);
					if ($export_r <> NULL) {
						echo '<p class="additional">Текущие</p>
						<div class="update-block">
						<ul class="export_list">';
							do {
								echo '<li>'.$export_r['name_country'].'</li>';
							}while ($export_r=mysqli_fetch_array($export_sql));
						echo '</ul></div>';
					}
			?>
		<form method="post" action="/editor/scripts/delete_export.php" target="result_frame">
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
		<button class="edit_but" onclick="reloadform()" type="submit" name="button" value="edit"><img src="../img/edit.png" width="16px" height="16px"></button>
		
			<?php echo '<input type="hidden" name="org_id" id="org_id" value="'.$org.'">';?>
			<button class="del_butt" onclick="confirm_delete()" type="submit" name="button" value="del"><img src="../img/delete.png" width="16px" height="16px"></button>
		</form>
		<iframe name="result_frame" style="display: none;"></iframe>
		</div>
	</div>
</div>

<script>
	 function reloadform()	{
 			setTimeout(function(){$('#exports-block').load('updating_organization/exports.php');},2000);
 }

 function confirm_delete() {
 			if(confirm('Вы уверены в удалении ЭТОГО экспортного рынка?'))
 			{
 				reloadform();
 			}
 		
</script>