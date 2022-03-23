<?php require_once("../connection.php");?>
<?php 

	$alt_name=mysqli_real_escape_string($bd,trim($_POST['alt_name']));

	$ornanization = mysqli_real_escape_string($bd,trim($_POST['organization']));

	$code_tn_ved = mysqli_real_escape_string($bd,trim($_POST['codetnved']));
	$codetnved_descr = mysqli_real_escape_string($bd,trim($_POST['codetnved_descr']));
	$production_descr = mysqli_real_escape_string($bd,trim($_POST['production_descr']));
	
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

	$checking_exist  = mysqli_query($bd, "SELECT * from production where id_predpriyatiya='".$ornanization."' and name_production='".$alt_name."' and image_href='".$image_href."'");
	$checking_exist = mysqli_fetch_array($checking_exist);
	if($checking_exist == NULL) {
	$sql =  "INSERT into production (name_production, id_predpriyatiya, image_href, description) values('".$alt_name."','".$ornanization."', '".$image_href."', '".$production_descr."')";
	$result = mysqli_query($bd, $sql);
	if($result) {
			$select_id_production = mysqli_query($bd, "SELECT id_product from production where name_production='".$alt_name."' and id_predpriyatiya='".$ornanization."'");
			$select_id_production = mysqli_fetch_array($select_id_production);
			$select_id_production = $select_id_production['id_product'];

			$codetnved_id = $_POST['codetnved_id'];
			if ($codetnved_id == '0' && $code_tn_ved <> NULL) {
				$codetnnved = $_POST['codetnved'];
				$codetnved_descr = $_POST['codetnved_descr'];
				$sql = "INSERT into code_tn_veds (code_tn_ved, id_predpriyatiya, description_code) values ('".$codetnnved."','".$ornanization."', '".$codetnved_descr."')";
				$result = mysqli_query($bd, $sql);
				$select_id_codetnved = mysqli_query($bd, "SELECT id_code_tn_ved from code_tn_veds where id_predpriyatiya='".$ornanization."' and code_tn_ved='".$codetnnved."'");
				$select_id_codetnved = mysqli_fetch_array($select_id_codetnved);
				$id_codetnved = $select_id_codetnved['id_code_tn_ved'];
				$query_update = mysqli_query($bd, "update production set id_codetnved='".$id_codetnved."' where id_product='".$select_id_production."'");
			}
			elseif($codetnved_id > '0' && $code_tn_ved == NULL) {
				$sql = "UPDATE production set id_codetnved='".$id_codetnved."' where id_product='".$select_id_production."'";
				$result = mysqli_query($bd, $sql);
			}

		if ($insert_query) {
			echo "<script>alert('Успешно добавлена продукция');</script>";
		}
	}
}
	else {
		echo "<script>alert('Данная продукция уже существует');</script>";
	}

?>