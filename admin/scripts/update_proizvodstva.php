<?php require_once("../connection.php");?>
<?php 
	$id_proizvodstva = $_POST['id_proizvodstva'];
	$org_id = $_POST['org_id'];
	$button = $_POST['button'];

if ($button == 'e') {

	require_once("../translit.php");
	
	if (is_uploaded_file($_FILES['file']['tmp_name'])) {
		$name = mt_rand(0, 10000);
		$types = array('image/gif', 'image/png', 'image/jpeg');
		$size = 1024000;
		$newname= translit($_FILES['file']['name']);
				$fm ="../proizvodstvo/".$ornanization."/";
					mkdir($_SERVER['DOCUMENT_ROOT']."/proizvodstvo/".$ornanization, 0777);
				if (!in_array($_FILES['file']['type'], $types))
		 			{die('Неверный тип файла. Выберите другой файл');}
				if ($_FILES['file']['size'] > $size)
		  			{die('Слишком большой размер файла.');}
		  		move_uploaded_file($_FILES['file']['tmp_name'], "../../proizvodstvo/".$ornanization."/".$newname);
		  		$image_href = "proizvodstvo/".$ornanization."/".$newname;
				$sql =  "update proizvodstva set img_proizv = '".$image_href."' where id_proizvodstva='".$id_proizvodstva."'";
	}
		$result = mysqli_query($bd, $sql);
		if($result) {
			echo '<span>Информация о продукции обновлена</span>';
		}
		}
		elseif ($button == 'd') {
			$query = mysqli_query($bd, "DELETE from production where id_product='".$prod_id."'");
			if($query) {
				echo '<span>Данная продукция будет удалена</span>';
			}
		}
	?>