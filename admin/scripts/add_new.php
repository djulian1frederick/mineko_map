<?php 
	session_start();
	require_once("../connection.php");
?>	

<?php 

	$news_title = $_POST['news_title'];
	
	$news_date = $_POST['news_date'];

	$news_text = $_POST['news'];
	$user_id = $_POST['iduser'];

	$preview_path = $_SESSION['full_path_image_preview'];
	$sql = "INSERT into news (news_title, news_text, news_date, id_user, news_img) values ('".$news_title."','".$news_text."','".$news_date."','".$user_id."', '".$preview_path."')";
	$result = mysqli_query($bd, $sql);
	if ($result) { echo "<span>Запись добавлена</span>";} else {mysqli_error();}

?>