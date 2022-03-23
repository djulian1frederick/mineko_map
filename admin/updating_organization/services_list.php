<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<?php 
	if(isset($_POST['orga_mo'])) {
	$org = $_POST['orga_mo'];	
	$_SESSION['orga_mo'] = $org;
}
	else {
		$org = $_SESSION['orga_mo'];
	}

?>
<div id="services_list">
<?php 
				$sql = "SELECT name_service,id_service from expoc_services where id_predpriyatiya ='".$org."'";
				$serv_q = mysqli_query($bd, $sql);
				$serv_l = mysqli_fetch_array($serv_q);
				do {
					echo '<form method="post" target="result_'.$serv_l['id_service'].'" action="/editor/scripts/update_services.php">';
					echo '<br><label for="newservice"><i>Услуга</i></label><br>';
						echo '<input type="hidden" name="id_serv" value="'.$serv_l['id_service'].'">';
						echo '<textarea name="newservice" value="'.$serv_l['name_service'].'">'.$serv_l['name_service'].'</textarea><br>';
						echo '<button type="submit" name="button" value="1" onclick="reloadform()"> ';
						echo '<img src="../img/edit.png" width="24px" height="24px"></button>';
						echo '<button type="submit" name="button" value="0" onclick="confirm_delete()">';
						echo '<img src="../img/delete.png" width="24px" height="24px"></button><br>';
						echo '<iframe style="width: 450px; height:40px;" borderless name="result_'.$serv_l['id_service'].'"></iframe>';
						echo '</form>';
				}while ($serv_l=mysqli_fetch_array($serv_q));
?>	
</div>
<script>
	 function reloadform()	{
 			setTimeout(function(){$('#services_list').load('updating_organization/services_list.php');},2000);
 }

	function confirm_delete() {
		if(confirm('Вы уверены, что хотите удалить данную услугу?')) {
			reloadform();
		}
	}
</script>