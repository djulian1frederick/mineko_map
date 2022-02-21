<?php require_once('../connection.php'); ?>
<?php 
	$orgid = $_POST['orgid'];
	$nameorg = $_POST['nameorg'];
	$inn = $_POST['inn'];
	$ogrn =$_POST['ogrn'];
	$sizepr = $_POST['sizepr'];
	$viddey = $_POST['viddey'];
	$codeprod = $_POST['codeprod'];
	$descr_organization = $_POST['descr_organization'];

		$viddeyadd = $_POST['viddeyadd'];
		$codeprodadd = $_POST['codeprodadd'];
	$year = $_POST['year'];

		if($viddeyadd <> "" || $viddeyadd <> NULL) {
			$viddey_sql = "INSERT into vid_deyat (vid_deyatelnosti) values ('".$viddeyadd."')";
			$viddey_q = mysqli_query($bd, $viddey_sql);
				$vidd_select = "SELECT id_vid_deyat from vid_deyat where vid_deyatelnosti='".$viddeyadd."'";
				$vidd_sel_q=mysqli_query($bd, $vidd_select);
				$vidd_sel_r = mysqli_fetch_array($vidd_sel_q);
				$viddey = $vidd_sel_r['id_vid_deyat'];
		}

		if ($codeprodadd <> "" || $codeprodadd <> NULL) {
			$codeprod_sql = "INSERT into code_product(code) values ('".$codeprodadd."')";
			$codeprod_q = mysqli_query($bd, $codeprod_sql);
				$code_prod_sel = "SELECT id_code_product from code_product where code='".$codeprodadd."'";
				$code_prod_q = mysqli_query($bd, $code_prod_sel);
				$code_prod_r = mysqli_fetch_array($code_prod_q);
				$codeprod = $code_prod_r['id_code_product'];
		}

	$update_sql = "UPDATE predpriyatiya set predpriyatiya.name = '".$nameorg."', predpriyatiya.descr_organization = '".$descr_organization."', predpriyatiya.inn = '".$inn."', predpriyatiya.ogrn='".$ogrn."', predpriyatiya.id_size = '".$sizepr."', predpriyatiya.id_vid_deyat = '".$viddey."', predpriyatiya.id_code_product = '".$codeprod."', predpriyatiya.yearstart = '".$year."' where id_predpriyatiya='".$orgid."'";

	$update_query = mysqli_query($bd, $update_sql);
		echo "<span><center>Обновлено.</center></span>";
?>