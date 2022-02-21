<?php require_once("connection.php");?>
<?php 
	$codetnnved = $_POST['codetnved'];
	$orgid = $_POST['orgid'];
	$idcode = $_POST['idcode'];

	$sql = "update code_tn_veds set code_tn_ved ='".$codetnnved."', id_predpriyatiya = '".$orgid."' where id_code_tnved = '".$idcode."' ";
	$update_query = mysqli_query($bd, $sql);

	if ($update_query) {
		echo '<span>Успешно обновлено</span>';
	}

?>