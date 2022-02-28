<?php require_once("../connection.php");?>
<?php 
	$codetnnved = $_POST['codetnnved'];
	$idcode = $_POST['idcode'];
	$codetnved_descr = $_POST['codetnved_descr'];

	$button= $_POST['button'];
	if($button == "del") {
		$query = mysqli_query($bd, "delete from code_tn_veds where id_code_tn_ved='".$idcode."'");
		if($query) {
			echo '<span>Запись будет удалена</span>';
		}
	}
	else {
		$sql = "update code_tn_veds set code_tn_ved ='".$codetnnved."', description_code = '".$codetnved_descr."' where id_code_tn_ved = '".$idcode."' ";
		$update_query = mysqli_query($bd, $sql);

		if ($update_query) {
			echo '<span>Успешно обновлено</span>';
		}
	}

?>