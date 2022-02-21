<?php require_once("../connection.php");?>
<?php 
	$idcode = $_POST['idcode'];

	$sql = "delete from code_tn_veds where id_code_tnved = '".$idcode."' ";
	$delete_query = mysqli_query($bd, $sql);

	if ($update_query) {
		echo '<span>Успешно удалено</span>';
	}
?>