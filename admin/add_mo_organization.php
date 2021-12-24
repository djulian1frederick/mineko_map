<?php require_once("connection.php");?>
<?php 
	$organization = $_POST['organization'];
	$raion = $_POST['ra_mo'];
	
	$sql = "UPDATE predpriyatiya set id_mo='".$raion."' where id_predpriyatiya='".$organization."'";
	$update = mysqli_query($bd, $sql);	
?>