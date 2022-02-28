<?php require_once("../connection.php");?>
<?php 

	$alt_name=$_POST['alt_name'];

	$ornanization = $_POST['organization'];

	$codetnved_descr = $_POST['codetnved_descr'];
	$production_descr = $_POST['production_descr'];
	$name = mt_rand(0, 10000);
	$types = array('image/gif', 'image/png', 'image/jpeg');
	$size = 1024000;

	require_once("../translit.php");

	$newname= translit($_FILES['file']['name']);

	$fm =$_SERVER['DOCUMENT_ROOT']."/production_img/".$ornanization."/";

		mkdir($_SERVER['DOCUMENT_ROOT']."/production_img/".$ornanization, 0777);
			if (is_uploaded_file($_FILES['file']['tmp_name'])) {
				if (!in_array($_FILES['file']['type'], $types))
		 			{die('Неверный тип файла. Выберите другой файл');}
				if ($_FILES['file']['size'] > $size)
		  			{die('Слишком большой размер файла.');}
		  		move_uploaded_file($_FILES['file']['tmp_name'], $fm."".$newname);
		}
	$image_href = "production_img/".$ornanization."/".$newname;


	$sql =  "INSERT into production (name_production, id_predpriyatiya, image_href, description) values('".$alt_name."','".$ornanization."', '".$image_href."', '".$production_descr."')";

	$result = mysqli_query($bd, $sql);
	if($result) {
			$select_id_production = mysqli_query($bd, "SELECT id_product from production where name_production='".$alt_name."' and id_predpriyatiya='".$ornanization."'");
			$select_id_production = mysqli_fetch_array($select_id_production);
			$select_id_production = $select_id_production['id_product'];

			$codetnved_id = $_POST['codetnved_id'];
			if ($codetnved_id == '0') {
				$codetnnved = $_POST['codetnved'];
				$codetnved_descr = $_POST['codetnved_descr'];
				$sql = "INSERT into code_tn_veds (code_tn_ved, id_predpriyatiya, description_code, id_product) values ('".$codetnnved."','".$ornanization."', '".$codetnved_descr."','".$select_id_production."')";
			}
			else {
				$sql = "UPDATE code_tn_veds set id_product='".$select_id_production."' where id_code_tn_ved='".$codetnved_id."'";
			}
			$insert_query = mysqli_query($bd, $sql);

		if ($insert_query) {
			echo '<span>Успешно добавлено</span>';
		}
	}

?>