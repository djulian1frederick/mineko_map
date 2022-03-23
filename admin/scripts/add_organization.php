<?php require_once("../connection.php");?>
<?php 
	$nameorg = $_POST['nameorg'];
	$inn = $_POST['inn'];
	$ogrm = $_POST['ogrn'];
	$ra_mo = $_POST['ra_mo'];

	if ($nameorg <> NULL){
		$checking = mysqli_query($bd, "SELECT inn from predpriyatiya where inn='".$inn."'");
		$checking = mysqli_fetch_array($checking);
		if($checking == NULL)
	{$sql= "INSERT into predpriyatiya (name, inn, ogrn, yearstart, id_mo) values ('".$nameorg."','".$inn."','".$ogrm."', '".$year."', '".$ra_mo."')";

	$insert_org = mysqli_query($bd, $sql);}
	else {
		echo "<script>alert('Такая организация уже существует');</script>";
	}
}
	if($insert_org) {
		echo "<script>alert('Успешно добавлена организация');</script>";
	}

?>