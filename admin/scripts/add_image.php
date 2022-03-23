<?php require_once("../connection.php");?>
<?php 
	$rfam=$_POST['rukovoditel'];

if($rfam <> NULL) {
	$name = mt_rand(0, 10000);
	$types = array('image/gif', 'image/png', 'image/jpeg');
	$size = 1024000;

		mkdir($_SERVER['DOCUMENT_ROOT']."/rukovoditeli_img/".$rfam."for".$name, 0777);
			if (is_uploaded_file($_FILES['file']['tmp_name'])) {
				if (!in_array($_FILES['file']['type'], $types))
		 			{die('Неверный тип файла. Выберите другой файл');}
				if ($_FILES['file']['size'] > $size)
		  			{die('Слишком большой размер файла.');}
		  		move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/rukovoditeli_img/".$rfam."for".$name."/".$_FILES['file']['name']);
		}
	$href_mr = "rukovoditeli_img/".$rfam."for".$name."/".$_FILES['file']['name'];

	$sql_update = "UPDATE rukovoditeli set img_href='".$href_mr."' where id_rukovoditel='".$rfam."' ";
	$result = mysqli_query($bd, $sql_update);
	if ($result) {
		echo 'alert("Успешно добавлено фото руководителю")';
	}
}
else {
	echo 'alert("Не выбран руководитель!")';
}

?>
