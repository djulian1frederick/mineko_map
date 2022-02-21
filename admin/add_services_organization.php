<?php require_once("connection.php");?>
<?php 
	$exp_service = $_POST['exp_service'];
	$orga_mo = $_POST['orga_mo'];
	
	$sql = "INSERT into expoc_services (name_service, id_predpriyatiya) values ('".$exp_service."','".$orga_mo."')";
	$insert = mysqli_query($bd, $sql);
	if($insert) {
		echo '<span>Успешно добавлено</span>';
	}	
?>