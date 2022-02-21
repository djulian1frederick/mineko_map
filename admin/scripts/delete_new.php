<?php 
	session_start();
	require_once("../connection.php");
?>	

<?php 
	$idnew = $_POST['idnew'];

	$sql = "delete from news where id_news='".$idnew."'";
	$query = mysqli_query($bd, $sql);
	if ($query) { echo '<span>Публикация удалена</span>';}
?>