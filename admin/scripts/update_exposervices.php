<?php require_once("../connection.php");?>
<?php 
	$name_service = $_POST['name_service'];
	$org_id = $_POST['org_id'];
		
	require_once("../translit.php");
	

	
	
	else {
		$sql =  "update production set production.name_production = '".$alt_name."', production.description='".$descript."' where production.id_product='".$prod_id."'";
	}
		$result = mysqli_query($bd, $sql);
		if($result) {
			echo '<span>Информация о продукции обновлена</span>';
		}
	?>