<?php require_once('../connection.php'); ?>
<?php 
	$org = $_POST['orga_mo'];	
?>
<?php 
				$sql = "SELECT name_service,id_service from expoc_services where id_predpriyatiya ='".$org."'";
				$serv_q = mysqli_query($bd, $sql);
				$serv_l = mysqli_fetch_array($serv_q);
				do {
					echo '<br><label for="newservice"><i>Услуга</i></label><br>';
						echo '<input type="hidden" id="id_serv_'.$serv_l['id_service'].'" value="'.$serv_l['id_service'].'">';
						echo '<textarea id="newservice_'.$serv_l['id_service'].'" name="newservice">'.$serv_l['name_service'].'</textarea><br>';
						echo '<button onclick="editservices_to_org("id'.$serv_l['id_service'].'")" value="1">';
						echo '<img src="../img/edit.png" width="24px" height="24px"></button>';
						echo '<button onclick="delservices_to_org("id'.$serv_l['id_service'].'")" value="0">';
						echo '<img src="../img/delete.png" width="24px" height="24px"></button><br>';
				}while ($serv_l=mysqli_fetch_array($serv_q));
?>	