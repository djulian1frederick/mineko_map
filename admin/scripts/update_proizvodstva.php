<?php require_once("../connection.php");?>
<?php 
	$id_proizvodstva = $_POST['id_proizvodstva'];
	$org_id = $_POST['org_id'];
	$button = $_POST['button'];

	
		$image_href = mysqli_query($bd, "SELECT img_proizv from proizvodstva where id_proizvodstva='".$id_proizvodstva."'");
		$image_href = mysqli_fetch_array($image_href);
		$image_href = $image_href['img_proizv'];
		$query = mysqli_query($bd, "DELETE from proizvodstva where id_proizvodstva='".$id_proizvodstva."'");
		unlink($_SERVER['DOCUMENT_ROOT']."/".$image_href);
			if($query) {
				echo '<span class="message">Данное фото будет удалено</span>';
			}
	?>