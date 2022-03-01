<?php require_once('../connection.php'); ?>
<?php 
	$orgid = $_POST['org_id'];
	$country = $_POST['exports'];
	$button = $_POST['button'];
	
if($button == 'edit') {
	$sql_check = "SELECT id_export from exports where id_predpriyatiya='".$orgid."' and id_country='".$country."'";
	$check_query = mysqli_query($bd, $sql_check);
	$check_line = mysqli_fetch_array($check_query);

	 if ($check_line == NULL) {
	 	$sql_insert = "INSERT into exports(id_predpriyatiya, id_country) values ('".$orgid."','".$country."')";
	 	$insert_query = mysqli_query($bd, $sql_insert);
	 		if($insert_query) { echo '<span style="text-align: center;">запись об экспортном рынке добавлена</span>';}
	 }
	 else {
	 	echo "<span class='message'>такой рынок уже добавлен</span>";
	 }
}
else {
	$sql_1 = "delete from exports where id_predpriyatiya = '".$orgid."' and id_country='".$country."'";
	$query_1 = mysqli_query($bd, $sql_1);
	echo "<span class='message'>Запись будет удалена</span>";
}

?>