<?php require_once("../connection.php");?>
<?php 
	$codetnnved = $_POST['codetnved'];
	$orgid = $_POST['orgid'];
	$codetnved_descr = $_POST['codetnved_descr'];

	$sql = "INSERT into code_tn_veds (code_tn_ved, id_predpriyatiya, description_code) values ('".$codetnnved."','".$orgid."', '".$codetnved_descr."')";
	$insert_query = mysqli_query($bd, $sql);

	if ($insert_query) {
		echo "<script>alert('Код ТН ВЭД добавлен успешно');</script>";
	}

?>