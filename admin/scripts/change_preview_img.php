<?php
session_start();

	require_once("../connection.php");

	$oldpath = $_POST['oldphoto'];
	if($oldpath <> NULL) {
		unlink($_SERVER['DOCUMENT_ROOT']."".$oldpath);
	}
	$idnew = $_POST['idnew'];

	$name = mt_rand(0, 10000);
	$types = array('image/gif', 'image/png', 'image/jpeg');
	$size = 1024000;

	require_once("../translit.php");


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

	$sql = "UPDATE news set news_img='".$image_href."' where id_news='".$idnew."'";
	$query = mysqli_query($bd, $sql);
?>