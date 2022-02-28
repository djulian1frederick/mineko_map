<?php 
	session_start();
	require_once("../connection.php");
?>	

<?php 
	$button = $_POST['button'];
	$id_user = $_POST['userid'];

	if($button == 'personal') {
		$sql_1 = "delete from users where id_user = '".$id_user."'";
		$sql_2 = "delete from admins where id_user = '".$id_user."'";
		$sql_3 = "update checking_registration set id_user=NULL where id_user='".$id_user."'";
		$sql_4 = "delete from contacts_people where id_user='".$id_user."'";
		$query_1 = mysqli_query($bd, $sql_1);
		$query_2 = mysqli_query($bd, $sql_2);
		$query_3 = mysqli_query($bd, $sql_3);
		$query_4 = mysqli_query($bd, $sql_4);
	}
	elseif($button == 'zayavka'){
		$sql_1 = "delete from users where id_user = '".$id_user."'";
		$sql_2 = "delete from admins where id_user = '".$id_user."'";
		$sql_3 = "delete from checking_registration where id_user='".$id_user."'";
		$sql_4 = "delete from contacts_people where id_user='".$id_user."'";
		$query_1 = mysqli_query($bd, $sql_1);
		$query_2 = mysqli_query($bd, $sql_2);
		$query_3 = mysqli_query($bd, $sql_3);
		$query_4 = mysqli_query($bd, $sql_4);
	}
	
	if ($query_1 && $query_2 && $query_3) { header('Location: ../../index'); session_destroy();}
?>

<img src="../../img/loading.png" alt="Загрузка результата">