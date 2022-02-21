<?php
session_start();

	$name = mt_rand(0, 10000);
	$types = array('image/gif', 'image/png', 'image/jpeg');
	$size = 1024000;

	require_once("translit.php");


	$newname= translit($_FILES['upload']['name']);

	$folder = $_SERVER['DOCUMENT_ROOT']."/news_attach/".$name;
		mkdir($folder, 0777);
			if (is_uploaded_file($_FILES['upload']['tmp_name'])) {
				if (!in_array($_FILES['upload']['type'], $types))
		 			{die('Неверный тип файла. Выберите другой файл');}
				if ($_FILES['upload']['size'] > $size)
		  			{die('Слишком большой размер файла.');}
		  		move_uploaded_file($_FILES['upload']['tmp_name'], $folder."/".$newname);
		}
	$image_href = "/news_attach/".$name."/".$newname;

	$_SESSION['full_path_image_preview'] = $image_href;
	if(isset($_SESSION['full_path_image_preview'])) {
		echo '<div style="width: 640px; height: 480px; overflow: hidden; border: 1px solid transparent;">';
			echo '<img src="..'.$image_href.'" style="width: 100%; heigt: auto; display: block;">';
		echo '</div>';
	}
?>