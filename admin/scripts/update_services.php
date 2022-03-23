<?php require_once("../connection.php");?>
<?php 
	$id_serv = $_POST['id_serv'];

	$newservice = $_POST['newservice'];

	$button= $_POST['button'];
	if($button == "0") {
		$query = mysqli_query($bd, "delete from expoc_services where id_service='".$id_serv."'");
		if($query) {
			echo "<script>alert('Запись будет удалена');</script>";
		}
	}
	else {
		$sql = "update expoc_services set name_service ='".$newservice."' where id_service = '".$id_serv."' ";
		$update_query = mysqli_query($bd, $sql);

		if ($update_query) {
			echo "<script>alert('Успешно обновлено');</script>";
		}
	}
?>