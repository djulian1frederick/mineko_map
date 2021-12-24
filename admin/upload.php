<?php require_once("connection.php");?>
<?php 

	$alt_name=$_POST['alt_name'];

	$ornanization = $_POST['organization'];

	$name = mt_rand(0, 10000);
	$types = array('image/gif', 'image/png', 'image/jpeg');
	$size = 1024000;

	require_once("translit.php");

	$newname= translit($_FILES['file']['name']);

	$fm ="../production_img/".$ornanization."/";
		mkdir($_SERVER['DOCUMENT_ROOT']."/production_img/".$ornanization, 0777);
			if (is_uploaded_file($_FILES['file']['tmp_name'])) {
				if (!in_array($_FILES['file']['type'], $types))
		 			{die('Неверный тип файла. Выберите другой файл');}
				if ($_FILES['file']['size'] > $size)
		  			{die('Слишком большой размер файла.');}
		  		move_uploaded_file($_FILES['file']['tmp_name'], "../production_img/".$ornanization."/".$newname);
		}
	$image_href = "production_img/".$ornanization."/".$newname;


	$sql =  "INSERT into production (name_production, id_predpriyatia, image_href) values('".$alt_name."','".$ornanization."', '".$image_href."')";

	$result = mysqli_query($bd, $sql);

?>