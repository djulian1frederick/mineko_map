<?php require_once("../connection.php");?>
<?php 
	require_once("../translit.php");

	$organization = $_POST['org_id'];
	if(isset($organization) && $organization <> ""){
	$newname = translit($_FILES['file']['name']);
	$site = $_POST['site'];

	$types = array('image/gif', 'image/png', 'image/jpeg');
	$size = 1024000;

	if (is_uploaded_file($_FILES['file']['tmp_name'])) {
		if (!in_array($_FILES['file']['type'], $types))
			{die("Неверный тип файла. Поддерживаются png, gif, jpeg");}
		if ($_FILES['file']['size'] > $size) 
			{die('Слишком большой размер файла');}
		move_uploaded_file($_FILES['file']['tmp_name'], "../../logo_organizations/".$newname);	
		
		$image_href = "logo_organizations/".$newname;
		$sql_update = "UPDATE predpriyatiya set predpriyatiya.site='".$site."',predpriyatiya.logo='".$image_href."' where id_predpriyatiya='".$organization."'";
	}
	else {
		$sql_update = "UPDATE predpriyatiya set predpriyatiya.site='".$site."' where id_predpriyatiya='".$organization."'";
	}

	$updating = mysqli_query($bd, $sql_update);

		if($updating) {
			echo '<span>Обновлено</span>';
		}
}
?>