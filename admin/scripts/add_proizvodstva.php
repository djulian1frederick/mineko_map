<?php require_once("../connection.php");?>
<?php 
	$id_proizvodstva = $_POST['id_proizvodstva'];
	$org_id = $_POST['org_id'];
	$button = $_POST['button'];


		require_once("../translit.php");
		
		if (is_uploaded_file($_FILES['file']['tmp_name'])) {
			$name = mt_rand(0, 10000);
			$types = array('image/gif', 'image/png', 'image/jpeg');
			$size = 1024000;
			$newname= translit($_FILES['file']['name']);
				mkdir($_SERVER['DOCUMENT_ROOT']."/proizvodstvo/".$org_id, 0777);
					if (!in_array($_FILES['file']['type'], $types))
			 			{die('Неверный тип файла. Выберите другой файл');}
					if ($_FILES['file']['size'] > $size)
			  			{die('Слишком большой размер файла.');}
			  		move_uploaded_file($_FILES['file']['tmp_name'], "../../proizvodstvo/".$org_id."/".$newname);
			  		$image_href = "proizvodstvo/".$org_id."/".$newname;
					$sql =  "insert into proizvodstva (img_proizv, id_predpriyatiya) values('".$image_href."','".$org_id."')";
		}
			$result = mysqli_query($bd, $sql);
			if($result) {
				echo "<script>alert('Успешное добавление фотографии производства');</script>";
		}
	?>