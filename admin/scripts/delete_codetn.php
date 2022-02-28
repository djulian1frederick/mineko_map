	<?php require_once("../connection.php");?>
<?php 
	$idcode = $_POST['idcode'];
	$action = $_POST['action'];

	if(isset($id_code)) {
		$query = mysqli_query($bd, "delete from code_tn_ved where id_code_tnved='".$idcode."'");
		if($query) {
			echo '<span>Удалено</span>';
		}
	}

?>