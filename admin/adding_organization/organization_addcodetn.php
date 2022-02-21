<?php require_once("../connection.php");?>
<?php 
	$codetnnved = $_POST['codetnved'];
	$orgid = $_POST['orgid'];

	$sql = "INSERT into code_tn_veds (code_tn_ved, id_predpriyatiya) values ('".$codetnnved."','".$orgid."')";
	$insert_query = mysqli_query($bd, $sql);

	if ($insert_query) {
		echo '<span>Успешно добавлено</span>';
	}

?>