<?php require_once("../connection.php");?>
<?php 
	$prod_id = $_POST['prodid'];
	$alt_name = $_POST['production_name'];
	$descript = $_POST['descr'];
	$ornanization = $_POST['org_id'];
	$codetnved_id = $_POST['codetnved_id'];
	$button = $_POST['button'];

if ($button == 'e') {

	if (isset($codetnved_id) && $codetnved_id <> '' || $codetnved_id <> NULL) {
		$update_code = "UPDATE code_tn_veds set id_product='".$prod_id."' where id_code_tn_ved='".$codetnved_id."'";
		$query = mysqli_query($bd, $update_code);
	}

	
	require_once("../translit.php");
	

	
	if (is_uploaded_file($_FILES['file']['tmp_name'])) {
		$name = mt_rand(0, 10000);
		$types = array('image/gif', 'image/png', 'image/jpeg');
		$size = 1024000;
		$newname= translit($_FILES['file']['name']);
				$fm ="../production_img/".$ornanization."/";
					mkdir($_SERVER['DOCUMENT_ROOT']."/production_img/".$ornanization, 0777);
				if (!in_array($_FILES['file']['type'], $types))
		 			{die('Неверный тип файла. Выберите другой файл');}
				if ($_FILES['file']['size'] > $size)
		  			{die('Слишком большой размер файла.');}
		  		move_uploaded_file($_FILES['file']['tmp_name'], "../../production_img/".$ornanization."/".$newname);
		  		$image_href = "production_img/".$ornanization."/".$newname;
				$sql =  "update production set production.name_production = '".$alt_name."', production.image_href = '".$image_href."', production.description='".$descript."' where production.id_product='".$prod_id."'";
	}
	else {
		$sql =  "update production set production.name_production = '".$alt_name."', production.description='".$descript."' where production.id_product='".$prod_id."'";
	}
		$result = mysqli_query($bd, $sql);
		if($result) {
			echo '<span>Информация о продукции обновлена</span>';
		}
		}
		elseif ($button == 'd') {
			$query = mysqli_query($bd, "DELETE from production where id_product='".$prod_id."'");
		}
	?>