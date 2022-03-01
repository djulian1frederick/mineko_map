<?php 
	session_start();
	require_once("../connection.php");
?>	

<?php 
	$org_id = $_POST['org_id'];
	$exports = $_POST['exports'];
	$button = $_POST['button'];
	if($button == "edit") {
		include "update_exports.php";
	}
	else {
	$sql_1 = "delete from exports where id_predpriyatiya = '".$org_id."' and id_country='".$exports."'";
		$query_1 = mysqli_query($bd, $sql_1);
	}
?>