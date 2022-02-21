<?php require_once("../connection.php");?>
<?php 
	$codetnnved = $_POST['codetnved'];
	$idcode = $_POST['idcode'];
	$codetnved_descr = $_POST['codetnved_descr'];

	$sql = "update code_tn_veds set code_tn_ved ='".$codetnnved."', description_code = '".$codetnved_descr."' where id_code_tnved = '".$idcode."' ";
	$update_query = mysqli_query($bd, $sql);

	if ($update_query) {
		echo '<span>Успешно обновлено</span>';
	}

?>