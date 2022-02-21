<?php 
	session_start();
	require_once("../connection.php");
?>	

<?php 
	$idnew = $_POST['idnew'];
	$news_title = $_POST['news_title'];
	
	$news_date = $_POST['news_date'];

	$news_text = $_POST['news'];
	$user_id = $_POST['iduser'];

	$sql = "update news set news_title='".$news_title."', news_text='".$news_text."', news_date='".$news_date."', id_user='".$user_id."' where id_news = '".$idnew."'";
	$result = mysqli_query($bd, $sql);
	if ($result) { echo "<span>Публикация обновлена</span>";} else {mysqli_error();}

?>